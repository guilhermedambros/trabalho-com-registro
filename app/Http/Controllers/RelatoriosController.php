<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Pessoa;
use App\TipoPessoa;
use App\Demanda;
use App\Registro;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Auth;

class RelatoriosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('demanda_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $anos = [];
        for($i=date('Y');$i>=2020;$i--){$anos[]=$i;}
        return view('relatorios.index', compact('anos'));
    }

    public function gerar(Request $request)
    {
        abort_if(Gate::denies('demanda_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $demandas = Demanda::where('user_id', Auth::user()->id)
                    ->whereHas('registros', function (Builder $query) use ($request) {
                        $query->whereYear('data_registro',  $request->ano)
                        ->whereMonth('data_registro', $request->mes);
                    })->get();


        //dd($demandas);
        $pdf = PDF::loadView('relatorios.pdf', compact('demandas', 'request'));
        //return view('relatorios.pdf', compact('demandas', 'request'));
        
        $pdf->setPaper('A3', 'landscape');
        return $pdf->download($request->mes.'-'.$request->ano.'_registros.pdf');
    }
}
