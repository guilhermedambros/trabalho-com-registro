<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMaquinaRequest;
use App\Http\Requests\StoreMaquinaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Role;
use App\Maquina;
use App\TipoMaquina;
use App\Pessoa;
use App\SaldoPeriodo;
use App\Helpers\Helpers as Helper;

use Gate;
use Auth;

class MaquinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('maquina_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maquinas = Maquina::orderBy('descricao')->get();
        return view('maquinas.index', compact('maquinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoas = Pessoa::all();
        $maquinas = Maquina::all();
        $tipo_maquinas = TipoMaquina::all();
        return view('maquinas.create', compact('pessoas', 'maquinas','tipo_maquinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaquinaRequest $request)
    {
        $request->validate([
            'valor_hora' => 'required',
        ]);
        
        $valor_hora = $request['valor_hora'];
        $valor_hora = number_format($valor_hora, 2, ',', '.');
        $created_by = Auth::user()->id;

        $maquinas = new Maquina([            
            'proprietario_pessoa_id' => $request->proprietario_pessoa_id,
            'descricao' => $request->descricao,
            'valor_hora' => $valor_hora,
            'tipo_maquina_id' => $request->tipo_maquina_id,
            'created_by' => $created_by,
        ]);
            
        $maquinas->save();
        return redirect()->route('maquinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina)
    {
        //
        abort_if(Gate::denies('maquina_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('maquinas.show', compact('maquina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $maquinas = Maquina::find($id);
        $id = $maquinas->id;
        $pessoas = Pessoa::where('id', '=', $maquinas->proprietario_pessoa_id)->get();
        $tipo_maquinas = TipoMaquina::where('id', '=', $maquinas->tipo_maquina_id)->get();
        $valor_hora = $maquinas->valor_hora;

        return view('maquinas.edit', compact('id', 'maquinas', 'pessoas', 'tipo_maquinas', 'valor_hora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'valor_hora' => 'required',
        ]);

        $maquinas = Maquina::find($id);
        
        $maquinas->update($request->all());
        
        $updated_by = \Auth::user()->id;
    
        if($maquinas->save()){
            return redirect()->route('maquinas.index')->with(['tipo'=>'success', 'message' => 'Máquina ' . $maquinas->descricao . ' editada com sucesso!']);
        }

        return redirect()->back()->with(['tipo'=>'danger', 'message' => 'Não foi possível editar a máquina!'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina)
    {
        abort_if(Gate::denies('maquina_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maquina->delete();

        return back();
    }

    public function get_valor_hora(Request $request)
    {
        if (!empty($request)) {
            $existe_saldo = false;
            $maquina = Maquina::find(intval($request->id));
            $saldo = SaldoPeriodo::where('ano_exercicio', date('Y', strtotime(str_replace('/', '-', $request->data_realizacao))))->where('pessoa_id', Auth::user()->id)->first();

            if (!empty($saldo)) {
                if ($maquina->tipo_maquina_id == "1") {
                    if ($saldo->saldo_pesadas > 0) {
                        $existe_saldo = true;
                    }
                }

                if ($maquina->tipo_maquina_id == "2") {
                    if ($saldo->saldo_leves > 0) {
                        $existe_saldo = true;
                    }
                }
            } else {
                return response()->json([
                    'success' => true,
                    'data' => 'Você não possui saldo!'
                ]);
            }

            if ($existe_saldo) {
                $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "$1:$2:00", $request->tempo);
                sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                $valor_hora = (float) $maquina->valor_hora * $time_seconds;

                if ($maquina->tipo_maquina_id == "1") {
                    $saldo->saldo_pesadas = $saldo->saldo_pesadas - Helper::convertHoursToFloat($request->tempo);
                    if ($saldo->saldo_pesadas < 0) {
                        return response()->json([
                            'success' => true,
                            'data' => 'Você não possui saldo!'
                        ]);
                    }
                }

                if ($maquina->tipo_maquina_id == "2") {
                    $saldo->saldo_leves = $saldo->saldo_leves - Helper::convertHoursToFloat($request->tempo);
                    if ($saldo->saldo_leves < 0) {
                        return response()->json([
                            'success' => true,
                            'data' => 'Você não possui saldo!'
                        ]);
                    }
                }

                return response()->json([
                    'success' => true,
                    'data' => number_format($valor_hora, 2, ',', '.')
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data' => 'Você não possui saldo!'
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'data' => 'Ocorreu um erro!'
        ]);
    }
}
