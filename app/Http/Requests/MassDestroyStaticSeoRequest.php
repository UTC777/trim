<?php

namespace App\Http\Requests;

use App\Models\StaticSeo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStaticSeoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('static_seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:static_seos,id',
        ];
    }
}
