<?php
namespace App\Http\Controllers;

use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;
        $search = $request->search;
        $sliders = Slider::published()->where('location', 2)->get();

        if ($category) {
            $articles = Cache::remember("blog_articles_category_{$category}", 60 * 24, function () use ($category) {
                return Post::published()->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                })->orderBy('id', 'DESC')->paginate(12);
            });
        } elseif ($search) {
            $articles = Cache::remember("blog_articles_search_{$search}", 60 * 24, function () use ($search) {
                return Post::where('title', 'LIKE', '%' . $search . '%')->published()->orderBy('id', 'DESC')->paginate(12);
            });
        } else {
            $articles = Cache::remember('blog_articles', 60 * 24, function () {
                return Post::published()->orderBy('id', 'DESC')->paginate(12);
            });
        }

        $categories = ContentCategory::all();
        $tags = ContentTag::all();

        return view('site.blog.index', compact('articles', 'sliders', 'categories', 'tags'));
    }

    public function show(Post $post, $slug)
    {
        $article = Cache::remember("published_post_{$slug}", 60 * 24, function () use ($slug) {
            return Post::where('slug', $slug)->with('categories', 'tags')->first();
        });

        $categoryIds = $article->categories()->pluck('content_categories.id');

        $relatedPosts = Cache::remember("related_posts_{$article->id}", 60 * 24, function () use ($categoryIds, $article) {
            return Post::whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('content_categories.id', $categoryIds);
            })->whereNotIn('id', [$article->id])->where('published', 1)->latest()->take(2)->get();
        });

        $popularPosts = Cache::remember('popular_posts', 60 * 24, function () {
            return Post::orderByUniqueViews('desc')->take(3)->get();
        });

        views($article)->record();

        $viewcount = views($article)->unique()->remember()->count();

        $staticSeo = Cache::remember("static_seo_{$article->staticSeo->id}", 60 * 24, function () use ($article) {
            return $article->staticSeo;
        });

        $categories = ContentCategory::all();
        $tags = ContentTag::all();

        $articles = Post::published()->orderBy('id', 'DESC')->paginate(6);

        return view('site.blog.show', compact('article', 'viewcount', 'relatedPosts', 'popularPosts', 'staticSeo', 'categories', 'tags', 'articles'));
    }

    public function more_data(Request $request)
    {
        if ($request->ajax()) {
            $skip = $request->skip;
            $take = 8;
            $articles = Post::skip($skip)->take($take)->get();

            return response()->json($articles);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'comment' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);

        Comment::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'comment' => $request->input('comment'),
            'post_id' => $post->id,
            'published' => true, // Change this if you have a moderation system
        ]);

        return redirect()->route('blog.show', $post->slug)->with('success', 'Your comment has been posted.');
    }
}



