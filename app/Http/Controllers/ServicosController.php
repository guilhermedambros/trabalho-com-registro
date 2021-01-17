<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServicoRequest;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Role;
use App\Servico;
use App\Maquina;
use App\Pessoa;
use Gate;
use Auth;
use DB;
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
        $maquinas = Maquina::all();
        $servicos = [];
        return view('servicos.create', compact('servicos', 'maquinas', 'pessoas'));
    }

    public function store(StoreServicoRequest $request)
    {
        // DB::beginTransaction();
        $success = false;
        // try {
            $servico = new Servico([
                'descricao' => $request->descricao,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'data_realizacao' => $request->data_realizacao,
                'beneficiario_pessoa_id' => $request->beneficiario_pessoa_id,
            ]);

            $servico->save();
            dd($servico->id);
            $sync_data = [];
            if (!empty($request['pivot_maquina_id'])) {
                for ($i=0; $i < count($request['pivot_maquina_id']); $i++) {
                    $sync_data[$i]['servico_id'] = $servico->id;
                    $sync_data[$i]['maquina_id'] = $request['pivot_maquina_id'][$i];
                    $sync_data[$i]['tempo'] = $request['pivot_tempo'][$i];
                    $sync_data[$i]['valor'] = str_replace(",",".",str_replace(".","",$request['pivot_valor'][$i])) ?: 0;
                }
            }
            // dd($sync_data);
            $servico->maquinas()->sync($sync_data);
            $success = true;
        // }

        // if ($servicos->save()) {
            // return redirect()->route('servicos.index')->with('message', 'Serviço cadastrado!');
        // } else {
        //     return redirect()->route('servicos.index')->with('error', 'Ocorreu um erro!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Servico $servico)
    {
        abort_if(Gate::denies('servico_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('servicos.show', compact('servico'));
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
        $maquinas = Maquina::all();
        return view('servicos.edit', compact('servicos', 'maquinas', 'pessoas'));
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
        $servico = Servico::find($id);
        $servico->fill($request->all());

        if ($servico->save()) {
            return redirect()->route('servicos.index')->with('message', 'Serviço atualizado!');
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
        abort_if(Gate::denies('servico_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servico = Servico::findOrFail($id);
        $msg = 'Ocorreu um erro!';
        $typeMsg = 'error';
        if ($servico->delete()) {
            $msg = 'Servico excluído!';
            $typeMsg = 'success';
            $servico->deleted_by = Auth::user()->id;
            $servico->update();
        }

        return redirect()->route('servicos.index')->with($typeMsg, $msg);
    }

    public function massDestroy(MassDestroyServicoRequest $request)
    {
        Servico::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
