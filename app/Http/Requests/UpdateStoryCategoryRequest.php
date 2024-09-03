<?php

namespace App\Http\Requests;

use App\Models\StoryCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStoryCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('story_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
