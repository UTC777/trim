<?php

namespace App\Http\Requests;

use App\Models\Redirector;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRedirectorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('redirector_edit');
    }

    public function rules()
    {
        return [
            'redirect_from' => [
                'string',
                'nullable',
            ],
            'redirect_to' => [
                'string',
                'nullable',
            ],
        ];
    }
}
