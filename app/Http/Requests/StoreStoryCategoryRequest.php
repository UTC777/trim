<?php

namespace App\Http\Requests;

use App\Models\StoryCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoryCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('story_category_create');
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
