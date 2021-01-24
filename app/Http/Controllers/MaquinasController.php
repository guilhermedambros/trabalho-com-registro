<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMaquinaRequest;
use App\Http\Requests\StoreMaquinaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Role;
use App\Maquina;
use App\TipoMaquina;
use App\Pessoa;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        $maquinas = Maquina::orderBy('nome')->get();
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
        $created_by = \Auth::user()->id;

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
    public function show($id)
    {
        //
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
            $maquina = Maquina::find(intval($request->id));
            $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $request->tempo);
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
            $valor_hora = $maquina->valor_hora * $time_seconds;

            return response()->json([
                'success' => true,
                'data' => number_format($valor_hora, 2, ',', '.')
            ]);
        }
        return respose()->json([
            'success' => false,
            'data' => 'Ocorreu um erro!'
        ]);
    }
}
