@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seenon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seenons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.id') }}
                        </th>
                        <td>
                            {{ $seenon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $seenon->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.name') }}
                        </th>
                        <td>
                            {{ $seenon->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.description') }}
                        </th>
                        <td>
                            {!! $seenon->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.carousel_image') }}
                        </th>
                        <td>
                            @if($seenon->carousel_image)
                                <a href="{{ $seenon->carousel_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $seenon->carousel_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.featured_image') }}
                        </th>
                        <td>
                            @if($seenon->featured_image)
                                <a href="{{ $seenon->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $seenon->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.link_back') }}
                        </th>
                        <td>
                            {{ $seenon->link_back }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seenon.fields.slug') }}
                        </th>
                        <td>
                            {{ $seenon->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seenons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection