<?php

namespace App\Http\Requests;

use App\Models\SuccessStory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSuccessStoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('success_story_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'story_about' => [
                'string',
                'nullable',
            ],
            'services_useds.*' => [
                'integer',
            ],
            'services_useds' => [
                'array',
            ],
        ];
    }
}
