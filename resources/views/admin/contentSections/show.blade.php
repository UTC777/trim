@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contentSection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.id') }}
                        </th>
                        <td>
                            {{ $contentSection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.section_title') }}
                        </th>
                        <td>
                            {{ $contentSection->section_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.order') }}
                        </th>
                        <td>
                            {{ $contentSection->order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.section') }}
                        </th>
                        <td>
                            {{ $contentSection->section }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.location') }}
                        </th>
                        <td>
                            {{ App\Models\ContentSection::LOCATION_SELECT[$contentSection->location] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contentSection->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentSection.fields.pages') }}
                        </th>
                        <td>
                            @foreach($contentSection->pages as $key => $pages)
                                <span class="label label-info">{{ $pages->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection