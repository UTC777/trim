<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRedirectorRequest;
use App\Http\Requests\StoreRedirectorRequest;
use App\Http\Requests\UpdateRedirectorRequest;
use App\Models\Post;
use App\Models\Redirector;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RedirectorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Redirector::with(['post'])->select(sprintf('%s.*', (new Redirector())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'redirector_show';
                $editGate = 'redirector_edit';
                $deleteGate = 'redirector_delete';
                $crudRoutePart = 'redirectors';

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
                return '<input type="checkbox" disabled '.($row->published ? 'checked' : null).'>';
            });
            $table->editColumn('redirect_from', function ($row) {
                return $row->redirect_from ? $row->redirect_from : '';
            });
            $table->editColumn('redirect_to', function ($row) {
                return $row->redirect_to ? $row->redirect_to : '';
            });
            $table->editColumn('http_code', function ($row) {
                return $row->http_code ? Redirector::HTTP_CODE_SELECT[$row->http_code] : '';
            });
            $table->addColumn('post_title', function ($row) {
                return $row->post ? $row->post->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'post']);

            return $table->make(true);
        }

        return view('admin.redirectors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('redirector_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.redirectors.create', compact('posts'));
    }

    public function store(StoreRedirectorRequest $request)
    {
        $redirector = Redirector::create($request->all());

        return redirect()->route('admin.redirectors.index');
    }

    public function edit(Redirector $redirector)
    {
        abort_if(Gate::denies('redirector_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $redirector->load('post');

        return view('admin.redirectors.edit', compact('posts', 'redirector'));
    }

    public function update(UpdateRedirectorRequest $request, Redirector $redirector)
    {
        $redirector->update($request->all());

        return redirect()->route('admin.redirectors.index');
    }

    public function show(Redirector $redirector)
    {
        abort_if(Gate::denies('redirector_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redirector->load('post');

        return view('admin.redirectors.show', compact('redirector'));
    }

    public function destroy(Redirector $redirector)
    {
        abort_if(Gate::denies('redirector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redirector->delete();

        return back();
    }

    public function massDestroy(MassDestroyRedirectorRequest $request)
    {
        Redirector::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
