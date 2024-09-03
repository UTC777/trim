<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_edit');
    }

    public function rules()
    {
        return [
            'sub_title' => [
                'string',
                'nullable',
            ],
            'main_title' => [
                'string',
                'nullable',
            ],
            'sub_title_2' => [
                'string',
                'nullable',
            ],
            'slider_description' => [
                'string',
                'nullable',
            ],
            'text_heading' => [
                'string',
                'nullable',
            ],
            'heading_1' => [
                'string',
                'nullable',
            ],
            'heading_2' => [
                'string',
                'nullable',
            ],
            'heading_3' => [
                'string',
                'nullable',
            ],
            'text' => [
                'string',
                'nullable',
            ],
            'main_button_text' => [
                'string',
                'nullable',
            ],
            'main_button_link' => [
                'string',
                'nullable',
            ],
            'main_button_tab_index' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'second_button_text' => [
                'string',
                'nullable',
            ],
            'second_button_link' => [
                'string',
                'nullable',
            ],
            'second_button_tab_index' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
