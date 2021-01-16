@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.saldo_periodo.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('saldo_periodos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.id') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.pessoa_id') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->pessoa->nome ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.ano_exercicio') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->ano_exercicio ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.saldo_pesadas') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->saldo_pesadas ?? '' }}
                    </td>
                </tr>
                
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.saldo_leves') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->saldo_leves ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.created_by') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->criado_por->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($saldo_periodo->created_at)) ? date("d/m/Y", strtotime($saldo_periodo->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($saldo_periodo->updated_at)) ? date("d/m/Y", strtotime($saldo_periodo->updated_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.saldo_periodo.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $saldo_periodo->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('saldo_periodos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection