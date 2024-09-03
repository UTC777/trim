@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.faqQuestion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.faq-questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.id') }}
                        </th>
                        <td>
                            {{ $faqQuestion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $faqQuestion->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.html_asnwer') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $faqQuestion->html_asnwer ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.category') }}
                        </th>
                        <td>
                            {{ $faqQuestion->category->category ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.question') }}
                        </th>
                        <td>
                            {{ $faqQuestion->question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.answer') }}
                        </th>
                        <td>
                            {!! $faqQuestion->answer !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.html_answer') }}
                        </th>
                        <td>
                            {{ $faqQuestion->html_answer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.youtube_video_id_only') }}
                        </th>
                        <td>
                            {{ $faqQuestion->youtube_video_id_only }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.video_button_text') }}
                        </th>
                        <td>
                            {{ $faqQuestion->video_button_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.video_image') }}
                        </th>
                        <td>
                            @if($faqQuestion->video_image)
                                <a href="{{ $faqQuestion->video_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $faqQuestion->video_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.read_more_link') }}
                        </th>
                        <td>
                            {{ $faqQuestion->read_more_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqQuestion.fields.read_more_button_text') }}
                        </th>
                        <td>
                            {{ $faqQuestion->read_more_button_text }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.faq-questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection