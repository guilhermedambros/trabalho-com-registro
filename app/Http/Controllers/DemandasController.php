<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyDemandaRequest;
use App\Http\Requests\StoreDemandaRequest;
use App\Http\Requests\UpdateDemandaRequest;
use App\Role;
use App\Pessoa;
use App\Registro;
use App\Demanda;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;
use DB;
use Auth;
class DemandasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('demanda_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $demandas = Demanda::where('user_id', Auth::user()->id)->orderBy('data_prazo')->get();
        return view('demandas.index', compact('demandas'));
    }

    public function create()
    {
        abort_if(Gate::denies('demanda_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pessoas = Pessoa::orderBy('nome')->get();
        return view('demandas.create', compact('pessoas'));
    }

    public function store(StoreDemandaRequest $request)
    {
        Demanda::create($request->all());
        

        return redirect()->route('demandas.index');
    }

    public function edit(Demanda $demanda)
    {

        abort_if(Gate::denies('demanda_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(($demanda->user_id != Auth::user()->id), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pessoas = Pessoa::orderBy('nome')->get();
        return view('demandas.edit', compact('pessoas', 'demanda'));

    }

    public function update(UpdateDemandaRequest $request, Demanda $demanda)
    {
        $demanda->update($request->all());

        return redirect()->route('demandas.index');
    }

    public function show(Demanda $demanda)
    { //dd(Registro::all());
        abort_if(Gate::denies('demanda_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('demandas.show', compact('demanda'));
    }

    public function destroy(Demanda $demanda)
    {
        abort_if(Gate::denies('demanda_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $demanda->delete();

        return back();
    }

    public function massDestroy(MassDestroyDemandaRequest $request)
    {
        Demanda::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
