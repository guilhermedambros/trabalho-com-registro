<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipoMaquinaRequest;
use App\Http\Requests\StoreTipoMaquinaRequest;
use App\Http\Requests\UpdateTipoMaquinaRequest;
use App\TipoMaquina;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;

class TipoMaquinasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_maquina_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_maquinas = TipoMaquina::orderBy('descricao')->get();
        return view('tipo_maquinas.index', compact('tipo_maquinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipo_maquina_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipos_bonificacao = config('app.tipo_bonificacao');
        return view('tipo_maquinas.create', compact('tipos_bonificacao'));
    }

    public function store(StoreTipoMaquinaRequest $request)
    {
        $tipo_maquina = TipoMaquina::create($request->all());
        

        return redirect()->route('tipo_maquinas.index');
    }

    public function edit(TipoMaquina $tipo_maquina)
    {
        abort_if(Gate::denies('tipo_maquina_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tipos_bonificacao = config('app.tipo_bonificacao');
        
        return view('tipo_maquinas.edit', compact('tipo_maquina', 'tipos_bonificacao'));

    }

    public function update(UpdateTipoMaquinaRequest $request, TipoMaquina $tipo_maquina)
    {
        $tipo_maquina->update($request->all());

        return redirect()->route('tipo_maquinas.index');
    }

    public function show(TipoMaquina $tipo_maquina)
    {
        abort_if(Gate::denies('tipo_maquina_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tipo_maquinas.show', compact('tipo_maquina'));
    }

    public function destroy(TipoMaquina $tipo_maquina)
    {
        abort_if(Gate::denies('tipo_maquina_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_maquina->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoMaquinaRequest $request)
    {
        TipoMaquina::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
