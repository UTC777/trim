@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.successStory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.success-stories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.id') }}
                        </th>
                        <td>
                            {{ $successStory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.title') }}
                        </th>
                        <td>
                            {{ $successStory->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.story_about') }}
                        </th>
                        <td>
                            {{ $successStory->story_about }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.story') }}
                        </th>
                        <td>
                            {!! $successStory->story !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.before') }}
                        </th>
                        <td>
                            @if($successStory->before)
                                <a href="{{ $successStory->before->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $successStory->before->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.after') }}
                        </th>
                        <td>
                            @if($successStory->after)
                                <a href="{{ $successStory->after->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $successStory->after->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.combined') }}
                        </th>
                        <td>
                            @if($successStory->combined)
                                <a href="{{ $successStory->combined->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $successStory->combined->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.services_used') }}
                        </th>
                        <td>
                            @foreach($successStory->services_useds as $key => $services_used)
                                <span class="label label-info">{{ $services_used->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $successStory->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.successStory.fields.story_category') }}
                        </th>
                        <td>
                            {{ $successStory->story_category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.success-stories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection