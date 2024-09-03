<?php

namespace App\Http\Requests;

use App\Models\Seenon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSeenonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seenon_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'link_back' => [
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
