@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.redirector.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.redirectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.id') }}
                        </th>
                        <td>
                            {{ $redirector->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $redirector->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.redirect_from') }}
                        </th>
                        <td>
                            {{ $redirector->redirect_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.redirect_to') }}
                        </th>
                        <td>
                            {{ $redirector->redirect_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.http_code') }}
                        </th>
                        <td>
                            {{ App\Models\Redirector::HTTP_CODE_SELECT[$redirector->http_code] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.post') }}
                        </th>
                        <td>
                            {{ $redirector->post->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.redirector.fields.added_on') }}
                        </th>
                        <td>
                            {{ $redirector->added_on }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.redirectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection