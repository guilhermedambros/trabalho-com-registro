@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.pessoa.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('pessoas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.id') }}
                    </th>
                    <td>
                        {{ $pessoa->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.nome') }}
                    </th>
                    <td>
                        {{ $pessoa->nome }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.email') }}
                    </th>
                    <td>
                        {{ $pessoa->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.documento') }}
                    </th>
                    <td>
                        {{ $pessoa->documento }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.rg') }}
                    </th>
                    <td>
                        {{ $pessoa->rg ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.telefone') }}
                    </th>
                    <td>
                        {{ $pessoa->telefone ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.celular') }}
                    </th>
                    <td>
                        {{ $pessoa->celular ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.cep') }}
                    </th>
                    <td>
                        {{ $pessoa->cep ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.endereco') }}
                    </th>
                    <td>
                        {{ $pessoa->endereco ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.numero') }}
                    </th>
                    <td>
                        {{ $pessoa->numero ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.bairro') }}
                    </th>
                    <td>
                        {{ $pessoa->bairro ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.complemento') }}
                    </th>
                    <td>
                        {{ $pessoa->complemento ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.cidade') }}
                    </th>
                    <td>
                        {{ $pessoa->cidade ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.estado') }}
                    </th>
                    <td>
                        {{ $pessoa->estado ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.tipo_pessoa') }}
                    </th>
                    <td>
                        {{ $pessoa->tipo_pessoa->descricao ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.data_nascimento') }}
                    </th>
                    <td>
                        {{ $pessoa->data_nascimento ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.created_by') }}
                    </th>
                    <td>
                        {{ $pessoa->created_by ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.created_at') }}
                    </th>
                    <td>
                        {{ $pessoa->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.updated_at') }}
                    </th>
                    <td>
                        {{ $pessoa->updated_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $pessoa->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('pessoas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection