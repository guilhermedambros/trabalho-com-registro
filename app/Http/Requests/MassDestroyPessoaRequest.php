<?php

namespace App\Http\Requests;

use App\Pessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPessoaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pessoa_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pessoas,id',
        ];
    }
}
