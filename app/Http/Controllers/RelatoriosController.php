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
use DB;
class RelatoriosController extends Controller
{
    public function index_saldos()
    {
        abort_if(Gate::denies('relatorios_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pessoas = Pessoa::orderBy('nome')->pluck('nome', 'id');
        $periodos = SaldoPeriodo::distinct('ano_exercicio')->pluck('ano_exercicio', 'ano_exercicio');
        return view('relatorios.saldos.index', compact('pessoas', 'periodos'));
        
    }

    public function gera_relatorio_saldos(Request $request)
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
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('saldos.pdf');
    }

    public function index_servicos()
    {
        abort_if(Gate::denies('relatorios_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pessoas = Pessoa::orderBy('nome')->pluck('nome', 'id');
        $periodos = SaldoPeriodo::distinct('ano_exercicio')->pluck('ano_exercicio', 'ano_exercicio');
        return view('relatorios.servicos.index', compact('pessoas', 'periodos'));
        
    }

    public function gera_relatorio_servicos(Request $request)
    {
        abort_if(Gate::denies('relatorios_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = Servico::where('data_realizacao', '>=', $request->periodo_inicio)
            ->where('data_realizacao', '<=', $request->periodo_fim);
        if(!is_null($request->pessoa)){
            $query->where('pessoa_id', $request->pessoa);
        }
        $servicos = $query->orderBy('data_realizacao')->get();
        //return view('relatorios.servicos.pdf', compact('servicos', 'request'));
        $pdf = PDF::loadView('relatorios.servicos.pdf', compact('servicos', 'request'));
        
        $pdf->setPaper('A3', 'landscape');
        return $pdf->download('servicos.pdf');
    }
}
