<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Post;
use App\Models\StaticSeo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Post::with(['categories', 'tags'])->select(sprintf('%s.*', (new Post)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_show';
                $editGate = 'post_edit';
                $deleteGate = 'post_delete';
                $crudRoutePart = 'posts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published']);

            return $table->make(true);
        }

        return view('admin.posts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');
        $tags = ContentTag::pluck('name', 'id');
        $postCategories = [];
        $postTags = [];
        $authors = User::where('is_author', 1)->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.posts.create', compact('categories', 'tags', 'postCategories', 'postTags', 'authors'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));
        if ($request->input('featured_image', false)) {
            $post->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $post->id]);
        }

        $post = Post::findOrFail($post->id);

        $menuName = \Str::of($post->slug)->replace('-', ' ')->title();

        if ($post->featured_image) {
            $seo_image_url = $post->featured_image->getUrl();
        } else {
            $seo_image_url = '';
        }

        $post->staticSeo()->create([
            'post_id' => $post->id,
            'canonical' => '1',
            'content_type' => 'post',
            'menu_name' => $menuName,
            'page_name' => $menuName,
            'page_path' => 'blog/' . $post->slug,
            'open_graph_type' => 'article',
            'html_schema_1' => 'Thing',
            'html_schema_2' => 'CreativeWork',
            'html_schema_3' => 'Blog',
            'body_schema' => 'Article',
            'seo_image_url' => $seo_image_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'facebook_title' => $request->facebook_title,
            'facebook_description' => $request->facebook_description,
            'twitter_title' => $request->twitter_title,
            'twitter_description' => $request->twitter_description,
        ]);

        Cache::forget("static_seo_{$post->staticSeo->id}");

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');
        $tags = ContentTag::pluck('name', 'id');
        $staticSeo = StaticSeo::first();
        $post->load('categories', 'tags');
        $postCategories = $post->categories->pluck('id')->toArray();
        $postTags = $post->tags->pluck('id')->toArray();
        $authors = User::where('is_author', 1)->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.posts.edit', compact('categories', 'post', 'tags', 'postCategories', 'postTags', 'staticSeo', 'authors'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // Update post data
        $post->update($request->all());

        // Sync categories and tags
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            if (!$post->featured_image || $request->input('featured_image') !== $post->featured_image->file_name) {
                if ($post->featured_image) {
                    $post->featured_image->delete();
                }
                $post->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($post->featured_image) {
            $post->featured_image->delete();
        }

        $post = Post::findOrFail($post->id);

        $menuName = \Str::of($post->slug)->replace('-', ' ')->title();

        if ($post->featured_image) {
            $seo_image_url = $post->featured_image->getUrl();
        } else {
            $seo_image_url = '';
        }

        // Handle SEO data
        $seoData = [
            'menu_name' => $menuName,
            'page_name' => $menuName,
            'page_path' => 'blog/' . $post->slug,
            'seo_image_url' => $seo_image_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'facebook_title' => $request->facebook_title,
            'facebook_description' => $request->facebook_description,
            'twitter_title' => $request->twitter_title,
            'twitter_description' => $request->twitter_description,
        ];

        $post->staticSeo()->updateOrCreate(['post_id' => $post->id], $seoData);

        Cache::forget("static_seo_{$post->staticSeo->id}");

        return $request->preview ? response()->json($post->slug) : redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->load('categories', 'tags');
        $staticSeo = StaticSeo::getCached($post->staticSeo->id);

        return view('admin.posts.show', compact('post', 'staticSeo'));
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();
        Cache::forget("static_seo_{$post->staticSeo->id}");

        return back();
    }

    public function massDestroy(MassDestroyPostRequest $request)
    {
        $posts = Post::find(request('ids'));

        foreach ($posts as $post) {
            $post->delete();
            Cache::forget("static_seo_{$post->staticSeo->id}");
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('post_create') && Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Post();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
