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
                        {{ $pessoa->email ?? ''}}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.documento') }}
                    </th>
                    <td>
                        {{ $pessoa->documento ?? ''}}
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
                        {{ trans('cruds.pessoa.fields.tipo_pessoa') }}
                    </th>
                    <td>
                        @foreach($pessoa->tipo_pessoas as $key => $tipo_pessoa)
                            <span class="label label-info">{{ $tipo_pessoa->descricao }},</span>
                        @endforeach
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
                        {{ $pessoa->criado_por->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($pessoa->created_at)) ? date("d/m/Y", strtotime($pessoa->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.pessoa.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($pessoa->updated_at)) ? date("d/m/Y", strtotime($pessoa->updated_at)) : '' }}
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