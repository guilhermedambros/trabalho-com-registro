<?php

namespace App\Http\Requests;

use App\Registro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Helpers\Helpers;

class StoreRegistroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('registro_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'descricao'     => ['required',],
            'tempo' => ['required',],
            'data_registro' => ['required',]
            
            
        ];
    }
}
