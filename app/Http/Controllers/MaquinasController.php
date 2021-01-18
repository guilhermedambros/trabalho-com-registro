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
        $pessoas = Pessoa::query();
        $maquinas = Maquina::all();
        $tipo_maquinas = TipoMaquina::query();
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
        $maquinas = new Maquina([
            'descricao' => $request->descricao,
            'tipo_maquina_id' => $request->tipo_maquina_id,
            'valor_hora' => $request->valor_hora,
            'proprietario_pessoa_id' => Auth::user()->id,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
