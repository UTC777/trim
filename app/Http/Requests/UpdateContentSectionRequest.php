<?php

namespace App\Http\Requests;

use App\Models\ContentSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContentSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_section_edit');
    }

    public function rules()
    {
        return [
            'section_title' => [
                'string',
                'required',
            ],
            'order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pages.*' => [
                'integer',
            ],
            'pages' => [
                'array',
            ],
        ];
    }
}
