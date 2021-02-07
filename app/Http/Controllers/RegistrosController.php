<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRegistroRequest;
use App\Registro;
use App\Helpers\Helpers as Helper;
use Auth;
class RegistrosController extends Controller
{
    public function store($demanda, StoreRegistroRequest $request)
    {
        Helper::convertHoursToFloat($request['tempo']);
        $registro = new Registro();
        $registro->tempo = Helper::convertHoursToFloat($request['tempo']);
        $registro->data_registro = $request['data_registro'];
        $registro->descricao = $request['descricao'];
        $registro->user_id = Auth::user()->id;
        $registro->demanda_id = $demanda;
        $registro->save();

        return redirect()->route('demandas.show', $demanda);
    }
}
