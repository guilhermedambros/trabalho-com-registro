@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.maquina.fields.descricao') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-blue" href="{{ route('maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.id') }}
                    </th>
                    <td>
                        {{ $maquina->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.descricao') }}
                    </th>
                    <td>
                        {{ $maquina->descricao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.proprietario') }}
                    </th>
                    <td>
                        {{ $maquina->proprietario->nome }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.tipo_maquina') }}
                    </th>
                    <td>
                        {{ $maquina->tipo_maquina->descricao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.valor_hora') }}
                    </th>
                    <td>
                        R$ {{ $maquina->valor_hora ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($maquina->created_at)) ? date("d/m/Y", strtotime($maquina->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($maquina->updated_at)) ? date("d/m/Y", strtotime($maquina->updated_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.maquina.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $maquina->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-blue" href="{{ route('maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection