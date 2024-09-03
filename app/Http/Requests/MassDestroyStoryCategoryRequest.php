<?php

namespace App\Http\Requests;

use App\Models\StoryCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStoryCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('story_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:story_categories,id',
        ];
    }
}
