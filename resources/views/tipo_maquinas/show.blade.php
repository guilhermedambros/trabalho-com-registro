@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.tipo_maquina.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('tipo_maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.id') }}
                    </th>
                    <td>
                        {{ $tipo_maquina->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.descricao') }}
                    </th>
                    <td>
                        {{ $tipo_maquina->descricao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.valor_hora_subsidiado') }}
                    </th>
                    <td>
                        {{ $tipo_maquina->valor_hora_subsidiado }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.tipo_bonificacao') }}
                    </th>
                    <td>
                        {{ $tipo_maquina->tipo_bonificacao ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($tipo_maquina->created_at)) ? date("d/m/Y", strtotime($tipo_maquina->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($tipo_maquina->updated_at)) ? date("d/m/Y", strtotime($tipo_maquina->updated_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tipo_maquina.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $tipo_maquina->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('tipo_maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection