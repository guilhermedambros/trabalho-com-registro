<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServicoRequest;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Role;
use App\Servico;
use App\Pessoa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicosController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('servico_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicos = Servico::orderBy('nome')->get();
        return view('servicos.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoas = Pessoa::all();
        $servicos = [];
        return view('servicos.create', compact('servicos', 'pessoas'));
    }

    public function store(StoreServicoRequest $request)
    {
        $servicos = new Servico([
            'descricao' => $request->descricao,
            'numero' => $request->numero,
            'data_realizacao' => $request->data_realizacao,
            'beneficiario_pessoa_id' => $request->beneficiario_pessoa_id,
        ]);

        if ($servicos->save()) {
            return redirect('servicos')->with('success', 'Serviço cadastrado!');
        } else {
            return redirect('servicos')->with('error', 'Ocorreu um erro!');
        }
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
        $servicos = Servico::find($id);
        $pessoas = Pessoa::all();
        return view('servicos.edit', compact('servicos', 'pessoas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicoRequest $request, $id)
    {
        $servicos = Servico::find($id);
        $servicos->fill($request->all());
        if ($servicos->update()) {
            return redirect()->route('servicos.index')->with('success', 'Serviço atualizado!');
        } else {
            return redirect()->route('servicos.index')->with('error', 'Ocorreu um erro!');
        }
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
