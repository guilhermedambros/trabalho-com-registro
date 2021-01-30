<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServicoRequest;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Role;
use App\Servico;
use App\Maquina;
use App\Pessoa;
use App\SaldoPeriodo;
use App\Helpers\Helpers as Helper;

use Gate;
use Auth;
use DB;

class ServicosController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('servico_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicos = Servico::all();
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
        DB::beginTransaction();
        $success = false;
        try {
            $servico = new Servico([
                'descricao' => $request->descricao,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'data_realizacao' => $request->data_realizacao,
                'beneficiario_pessoa_id' => $request->beneficiario_pessoa_id,
            ]);
            $servico->save();

            $saldos = SaldoPeriodo::where('pessoa_id', Auth::user()->id)->where('ano_exercicio', date('Y', strtotime(str_replace('/', '-', $request->data_realizacao))))->first();
            $saldo_leves = $saldos->saldo_leves;
            $saldo_pesadas = $saldos->saldo_pesadas;

            $sync_data = [];
            if (!empty($request['pivot_maquina_id'])) {
               
                for ($i=0; $i < count($request['pivot_maquina_id']); $i++) {
                    $sync_data[$i]['maquina_id'] = $request['pivot_maquina_id'][$i];
                    $sync_data[$i]['tempo'] = Helper::convertHoursToFloat($request['pivot_tempo'][$i]);
                    $sync_data[$i]['valor_total'] = str_replace(",",".",str_replace(".","",$request['pivot_valor_total'][$i])) ?: 0;
                    $sync_data[$i]['valor_subsidiado'] = 0;
                    $maquina = Maquina::find($request['pivot_maquina_id'][$i]);

                    if ($maquina->tipo_maquina_id == "1") {
                        $saldo_pesadas = (float) $saldo_pesadas - $sync_data[$i]['tempo'];
                    } elseif ($maquina->tipo_maquina_id == "2") {
                        $saldo_leves = (float) $saldo_leves - $sync_data[$i]['tempo'];
                    }
                }
            }

            if ($saldo_leves < 0) {
                DB::rollback();
                return redirect()->route('servicos.create')->with('message', 'Você não possui saldo!');
            } else {
                $saldos->saldo_leves = $saldo_leves;
                $saldos->save();
            }

            if ($saldo_pesadas < 0) {
                DB::rollback();
                return redirect()->route('servicos.create')->with('message', 'Você não possui saldo!');
            } else {
                $saldos->saldo_pesadas = $saldo_pesadas;
                $saldos->save();
            }

            $servico->maquinas()->sync($sync_data);
            $success = true;
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('servicos.index')->with('error', 'Ocorreu um erro!');
        }

        if ($success) {
            DB::commit();
            return redirect()->route('servicos.index')->with('message', 'Serviço cadastrado!');
        } else {
            DB::rollback();
            return redirect()->route('servicos.index')->with('error', 'Ocorreu um erro!');
        }
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

        $servico_maquinas = [];
        foreach ($servicos->maquinas as $key => $maquina) {
            $servico_maquinas[$key][$maquina->pivot->maquina_id]['maquina_id'] = $maquina->pivot->maquina_id;
            $servico_maquinas[$key][$maquina->pivot->maquina_id]['tempo'] = $maquina->pivot->tempo;
            $servico_maquinas[$key][$maquina->pivot->maquina_id]['valor_total'] = $maquina->pivot->valor_total;
        }

        return view('servicos.edit', compact('servicos', 'maquinas', 'pessoas', 'servico_maquinas'));
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

        $servico->update();
        $sync_data = [];
        if (!empty($request['pivot_maquina_id'])) {
            $saldos = SaldoPeriodo::where('pessoa_id', Auth::user()->id)->where('ano_exercicio', date('Y', strtotime(str_replace('/', '-', $request->data_realizacao))))->first();
            $saldo_leves = $saldos->saldo_leves;
            $saldo_pesadas = $saldos->saldo_pesadas;

            $servico->maquinas()->wherePivot('servico_id', $id)->detach();
            for ($i=0; $i < count($request['pivot_maquina_id']); $i++) {
                $sync_data[$i]['maquina_id'] = $request['pivot_maquina_id'][$i];
                $sync_data[$i]['tempo'] = Helper::convertHoursToFloat($request['pivot_tempo'][$i]);
                $sync_data[$i]['valor_total'] = str_replace(",",".",str_replace(".","",$request['pivot_valor_total'][$i]));
                $sync_data[$i]['valor_subsidiado'] = 0;

                $maquina = Maquina::find($request['pivot_maquina_id'][$i]);

                if ($maquina->tipo_maquina_id == "1") {
                    $saldo_pesadas = (float) $saldo_pesadas - $sync_data[$i]['tempo'];
                } elseif ($maquina->tipo_maquina_id == "2") {
                    $saldo_leves = (float)  $saldo_leves - $sync_data[$i]['tempo'];
                }
            }

            if ($saldo_leves < 0) {
                return redirect()->route('servicos.index')->with('error', 'Você não possui saldo!');
            } else {
                $saldos->saldo_leves = $saldo_leves;
                $saldos->save();
            }

            if ($saldo_pesadas < 0) {
                return redirect()->route('servicos.index')->with('error', 'Você não possui saldo!');
            } else {
                $saldos->saldo_pesadas = $saldo_pesadas;
                $saldos->save();
            }
            $servico->maquinas()->sync($sync_data);
        }
        return redirect()->route('servicos.index')->with('message', 'Serviço atualizado!');
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
