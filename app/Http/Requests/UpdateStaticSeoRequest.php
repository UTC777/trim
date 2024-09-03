<?php

namespace App\Http\Requests;

use App\Models\StaticSeo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaticSeoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('static_seo_edit');
    }

    public function rules()
    {
        return [
            'page_name' => [
                'string',
                'nullable',
            ],
            'page_path' => [
                'string',
                'nullable',
            ],
            'meta_title' => [
                'string',
                'nullable',
            ],
            'facebook_title' => [
                'string',
                'nullable',
            ],
            'twitter_title' => [
                'string',
                'nullable',
            ],
            'html_schema_1' => [
                'string',
                'nullable',
            ],
            'html_schema_2' => [
                'string',
                'nullable',
            ],
            'html_schema_3' => [
                'string',
                'nullable',
            ],
            'body_schema' => [
                'string',
                'nullable',
            ],
            'menu_name' => [
                'string',
                'nullable',
            ],
            'seo_image_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
