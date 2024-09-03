<?php

namespace App\Http\Requests;

use App\Models\Pagesection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;


class UpdatePagesectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('pagesection_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'section' => [
                'nullable',
            ],
            'section_nickname' => [
                'string',
                'nullable',
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
