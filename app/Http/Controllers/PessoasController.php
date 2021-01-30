<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPessoaRequest;
use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Role;
use App\Pessoa;
use App\TipoPessoa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;

class PessoasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pessoa_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pessoas = Pessoa::orderBy('nome')->get();
        return view('pessoas.index', compact('pessoas'));
    }

    public function create()
    {
        abort_if(Gate::denies('pessoa_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipo_pessoas = TipoPessoa::all()->pluck('descricao', 'id');
        
        return view('pessoas.create', compact('tipo_pessoas'));
    }

    public function store(StorePessoaRequest $request)
    {
        $pessoa = new Pessoa();
        $pessoa->nome = $request->nome;
        $pessoa->email = $request->email;
        $pessoa->documento = $request->documento;
        $pessoa->telefone = $request->telefone;
        $pessoa->celular = $request->celular ?? null;
        $pessoa->inscricao = $request->inscricao ?? null;
        $pessoa->cep = $request->cep ?? null;
        $pessoa->endereco = $request->endereco ?? null;
        $pessoa->bairro = $request->bairro ?? null;
        $pessoa->cidade = $request->cidade ?? null;
        $pessoa->numero = $request->numero ?? null;
        $pessoa->complemento = $request->complemento ?? null;
        $pessoa->data_nascimento = $request->data_nascimento ?? null;
        $pessoa->created_by = \Auth::user()->id;
        $pessoa->save();
        //$pessoa->tipo_pessoas()->sync($request->input('tipo_pessoas', []));
        

        return redirect()->route('pessoas.index');
    }

    public function edit(Pessoa $pessoa)
    {
        abort_if(Gate::denies('pessoa_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tipo_pessoas = TipoPessoa::all()->pluck('descricao', 'id');
        $pessoa->documento = Helpers::removeSpecialChar($pessoa->documento);
        return view('pessoas.edit', compact('tipo_pessoas', 'pessoa'));

    }

    public function update(UpdatePessoaRequest $request, Pessoa $pessoa)
    {
        //$request->input('tipo_pessoas') = Helpers::removeSpecialChar($request->input('tipo_pessoas'));
        //dd($request);
        $pessoa->update($request->all());
        $pessoa->tipo_pessoas()->sync($request->input('tipo_pessoas', []));

        return redirect()->route('pessoas.index');
    }

    public function show(Pessoa $pessoa)
    {
        abort_if(Gate::denies('pessoa_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pessoa->load('tipo_pessoas');

        return view('pessoas.show', compact('pessoa'));
    }

    public function destroy(Pessoa $pessoa)
    {
        abort_if(Gate::denies('pessoa_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pessoa->delete();

        return back();
    }

    public function massDestroy(MassDestroyPessoaRequest $request)
    {
        Pessoa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
