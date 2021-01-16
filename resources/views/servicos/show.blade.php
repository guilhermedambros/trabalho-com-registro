@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.servico.descricao') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('servicos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.id') }}
                    </th>
                    <td>
                        {{ $servico->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.descricao') }}
                    </th>
                    <td>
                        {{ $servico->descricao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.endereco') }}
                    </th>
                    <td>
                        {{ $servico->endereco }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.data_realizacao') }}
                    </th>
                    <td>
                        {{ $servico->data_realizacao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.numero') }}
                    </th>
                    <td>
                        {{ $servico->numero ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.beneficiario_pessoa_id') }}
                    </th>
                    <td>
                        {{ $servico->beneficiario->nome }}
                    </td>
                </tr>

                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.created_by') }}
                    </th>
                    <td>
                        {{ $servico->criado_por->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($servico->created_at)) ? date("d/m/Y", strtotime($servico->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($servico->updated_at)) ? date("d/m/Y", strtotime($servico->updated_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.servico.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $servico->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('servicos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection