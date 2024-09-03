<?php

namespace App\Http\Requests;

use App\Models\Redirector;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRedirectorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('redirector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:redirectors,id',
        ];
    }
}
