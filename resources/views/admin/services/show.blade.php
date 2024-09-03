@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $service->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.title') }}
                        </th>
                        <td>
                            {{ $service->title }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.service.fields.subtitle') }}
                        </th>
                        <td>
                            {{ $service->subtitle }}
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.service.fields.intro') }}
                        </th>
                        <td>
                            {{ $service->intro }}
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.content') }}
                        </th>
                        <td>
                            {{ $service->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.link') }}
                        </th>
                        <td>
                            {{ $service->link }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.service.fields.banner') }}
                        </th>
                        <td>
                            @if($service->banner)
                                <a href="{{ $service->banner->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $service->banner->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_photo') }}
                        </th>
                        <td>
                            @if($service->service_photo)
                                <a href="{{ $service->service_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $service->service_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection