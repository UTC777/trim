@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pagesection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pagesections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pagesection.fields.id') }}
                        </th>
                        <td>
                            {{ $pagesection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pagesection.fields.section') }}
                        </th>
                        <td>
                            {{ $pagesection->section }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pagesection.fields.section_nickname') }}
                        </th>
                        <td>
                            {{ $pagesection->section_nickname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pagesection.fields.order') }}
                        </th>
                        <td>
                            {{ $pagesection->order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pagesection.fields.pages') }}
                        </th>
                        <td>
                            @foreach($pagesection->pages as $key => $pages)
                                <span class="label label-info">{{ $pages->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pagesections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection