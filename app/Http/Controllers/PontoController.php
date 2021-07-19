<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ponto;
use Auth;
class PontoController extends Controller
{
    public function index(Request $request)
    {
        $data['mes'] = $request->select_mes ?? date('m');
        $data['ano'] = $request->select_ano ?? date('Y');
        $data['ultimo_dia_mes'] = date('t',strtotime($data['ano']."-".$data['mes']."-01"));
        $pontos = Ponto::whereMonth('data_ponto', $data['mes'])
                    ->whereYear('data_ponto', $data['ano'])
                    ->where('user_id',Auth::user()->id)
                    ->orderBy('data_ponto')->get();
        //dd(array_search("01/06/2021",$pontos));
        //dd($pontos);
        return view('ponto.index', compact('pontos', 'data'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $ultimo_dia_mes = date('t',strtotime($request['ano']."-".$request['mes']."-01"));
        foreach(range(1,$ultimo_dia_mes) as $dia){
            $ponto = (Ponto::where('data_ponto', $request['ano'].'-'.$request['mes'].'-'.str_pad($dia, 2, '0', STR_PAD_LEFT))
                        ->where('user_id', Auth::user()->id)
                        ->first()) 
                    ?? new Ponto();
            $label_padrao = str_pad($dia, 2, '0', STR_PAD_LEFT).$request['mes'].$request['ano'];
            $label_dia = 'dia_'.$label_padrao;
            $label_11 = 'turno_1_entrada_'.$label_padrao;
            $label_12 = 'turno_1_saida_'.$label_padrao;
            $label_21 = 'turno_2_entrada_'.$label_padrao;
            $label_22 = 'turno_2_saida_'.$label_padrao;

            $ponto->data_ponto = $request->$label_dia;
            $ponto->turno_1_entrada = $request->$label_11;
            $ponto->turno_1_saida = $request->$label_12;
            $ponto->turno_2_entrada = $request->$label_21;
            $ponto->turno_2_saida = $request->$label_22;
            $ponto->user_id = Auth::user()->id;
            $ponto->save();
        }
        //dd(Ponto::truncate());
        //dd(Ponto::where('data_ponto', '2021-06-01')->get());
        return redirect()->route('ponto.index');
    }
}
