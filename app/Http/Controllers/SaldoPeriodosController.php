<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySaldoPeriodoRequest;
use App\Http\Requests\StoreSaldoPeriodoRequest;
use App\Http\Requests\UpdateSaldoPeriodoRequest;
use App\Role;
use App\SaldoPeriodo;
use App\Pessoa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;
use Redirect;

class SaldoPeriodosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('saldo_periodo_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $saldo_periodos = SaldoPeriodo::where('ano_exercicio', date('Y'))->get();
        return view('saldo_periodos.index', compact('saldo_periodos'));
    }

    public function create()
    {
        abort_if(Gate::denies('saldo_periodo_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pessoas = Pessoa::orderBy('nome')->get();
        return view('saldo_periodos.create', compact('pessoas'));
    }

    public function store(StoreSaldoPeriodoRequest $request)
    {
        $sd = SaldoPeriodo::where('ano_exercicio', $request->ano_exercicio)->where('pessoa_id', $request->pessoa_id)->first();
        if($sd)
            return Redirect::back()->withErrors(['A pessoa "'.$sd->pessoa->nome.'" já possui saldo cadastrado para o ano de '.$sd->ano_exercicio]);
        $saldo_periodo = new SaldoPeriodo();
        $saldo_periodo->ano_exercicio = $request->ano_exercicio;
        $saldo_periodo->saldo_pesadas = $request->saldo_pesadas;
        $saldo_periodo->saldo_leves = $request->saldo_leves;
        $saldo_periodo->pessoa_id = $request->pessoa_id;
        $saldo_periodo->created_by = \Auth::user()->id;
        $saldo_periodo->save();
        

        return redirect()->route('saldo_periodos.index');
    }

    public function edit(SaldoPeriodo $saldo_periodo)
    {
        abort_if(Gate::denies('saldo_periodo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('saldo_periodos.edit', compact('saldo_periodo'));

    }

    public function update(UpdateSaldoPeriodoRequest $request, SaldoPeriodo $saldo_periodo)
    {
        $saldo_periodo->update($request->all());

        return redirect()->route('saldo_periodos.index');
    }

    public function show(SaldoPeriodo $saldo_periodo)
    {
        abort_if(Gate::denies('saldo_periodo_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('saldo_periodos.show', compact('saldo_periodo'));
    }

    public function destroy(SaldoPeriodo $saldo_periodo)
    {
        abort_if(Gate::denies('saldo_periodo_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saldo_periodo->delete();

        return back();
    }

    public function massDestroy(MassDestroySaldoPeriodoRequest $request)
    {
        SaldoPeriodo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function ajusta_saldos_do_periodo_atual(){
        if(SaldoPeriodo::ajusta_saldos_do_periodo_atual())
            return redirect()->route('admin.home');

        return redirect()->route('saldo_periodos.index');
    }
}
