<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaldoPeriodo;
use App\Pessoa;
use App\Servico;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;
use Redirect;
use PDF;

class RelatoriosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('relatorios_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pessoas = Pessoa::orderBy('nome')->pluck('nome', 'id');
        $periodos = SaldoPeriodo::distinct('ano_exercicio')->pluck('ano_exercicio', 'ano_exercicio');
        return view('relatorios.saldos.index', compact('pessoas', 'periodos'));
        
    }

    public function gera_relatorio(Request $request)
    {
        abort_if(Gate::denies('relatorios_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = SaldoPeriodo::where('ano_exercicio', $request->ano_exercicio);
        if(!is_null($request->pessoa)){
            $query->where('pessoa_id', $request->pessoa);
        }
        $saldos = $query->get();
        //dd($saldos);
        return view('relatorios.saldos.pdf', compact('saldos'));
        $pdf = PDF::loadView('relatorios.saldos.pdf', compact('saldos'));
        return $pdf->download('saldos.pdf');
    }
}
