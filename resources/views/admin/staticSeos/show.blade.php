@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.staticSeo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.static-seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.id') }}
                        </th>
                        <td>
                            {{ $staticSeo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.page_name') }}
                        </th>
                        <td>
                            {{ $staticSeo->page_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.page_path') }}
                        </th>
                        <td>
                            {{ $staticSeo->page_path }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $staticSeo->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.facebook_title') }}
                        </th>
                        <td>
                            {{ $staticSeo->facebook_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.twitter_title') }}
                        </th>
                        <td>
                            {{ $staticSeo->twitter_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.content_type') }}
                        </th>
                        <td>
                            {{ App\Models\StaticSeo::CONTENT_TYPE_SELECT[$staticSeo->content_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.json_ld_tag') }}
                        </th>
                        <td>
                            {{ $staticSeo->json_ld_tag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.canonical') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->canonical ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.html_schema_1') }}
                        </th>
                        <td>
                            {{ $staticSeo->html_schema_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.html_schema_2') }}
                        </th>
                        <td>
                            {{ $staticSeo->html_schema_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.html_schema_3') }}
                        </th>
                        <td>
                            {{ $staticSeo->html_schema_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.body_schema') }}
                        </th>
                        <td>
                            {{ $staticSeo->body_schema }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.facebook_description') }}
                        </th>
                        <td>
                            {{ $staticSeo->facebook_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.twitter_description') }}
                        </th>
                        <td>
                            {{ $staticSeo->twitter_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $staticSeo->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.open_graph_type') }}
                        </th>
                        <td>
                            {{ App\Models\StaticSeo::OPEN_GRAPH_TYPE_SELECT[$staticSeo->open_graph_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.seo_image') }}
                        </th>
                        <td>
                            @if($staticSeo->seo_image)
                                <a href="{{ $staticSeo->seo_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $staticSeo->seo_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.menu_name') }}
                        </th>
                        <td>
                            {{ $staticSeo->menu_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.seo_image_url') }}
                        </th>
                        <td>
                            {{ $staticSeo->seo_image_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.noindex') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noindex ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.nofollow') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->nofollow ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.noimageindex') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noimageindex ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.noarchive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noarchive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staticSeo.fields.nosnippet') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staticSeo->nosnippet ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.static-seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection