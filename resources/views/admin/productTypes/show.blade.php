@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.id') }}
                        </th>
                        <td>
                            {{ $productType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $productType->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.name') }}
                        </th>
                        <td>
                            {{ $productType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.slug') }}
                        </th>
                        <td>
                            {{ $productType->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productType.fields.photos') }}
                        </th>
                        <td>
                            @if($productType->photos)
                                <a href="{{ $productType->photos->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productType->photos->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection