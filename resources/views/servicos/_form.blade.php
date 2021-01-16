@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.servico.title_singular') }}
    </div>

    <form method="POST" action="{{ route($routes, old('id') ?? $servicos->id ?? null) }}" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.servico.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') ?? $servicos->descricao ?? null }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="endereco" class="text-xs required">{{ trans('cruds.servico.fields.endereco') }}</label>

                <div class="form-group">
                    <input type="text" id="endereco" name="endereco" class="{{ $errors->has('endereco') ? ' is-invalid' : '' }}" value="{{ old('endereco') ?? $servicos->endereco ?? null }}" required>
                </div>
                @if($errors->has('endereco'))
                    <p class="invalid-feedback">{{ $errors->first('endereco') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_realizacao" class="text-xs required">{{ trans('cruds.servico.fields.data_realizacao') }}</label>

                <div class="form-group">
                    <input type="text" id="data_realizacao" name="data_realizacao" class="{{ $errors->has('data_realizacao') ? ' is-invalid' : '' }} date" value="{{ old('data_realizacao') ?? $servicos->data_realizacao ?? null }}" required>
                </div>
                @if($errors->has('data_realizacao'))
                    <p class="invalid-feedback">{{ $errors->first('data_realizacao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="numero" class="text-xs required">{{ trans('cruds.servico.fields.numero') }}</label>

                <div class="form-group">
                    <input type="text" id="numero" name="numero" class="{{ $errors->has('numero') ? ' is-invalid' : '' }}" value="{{ old('numero') ?? $servicos->numero ?? null }}" required>
                </div>
                @if($errors->has('data_realizacao'))
                    <p class="invalid-feedback">{{ $errors->first('data_realizacao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="beneficiario_pessoa_id" class="text-xs required">{{ trans('cruds.servico.fields.beneficiario_pessoa_id') }}</label>

                <div class="form-group">
                    <select  id="beneficiario_pessoa_id" name="beneficiario_pessoa_id" class="{{ $errors->has('beneficiario_pessoa_id') ? ' is-invalid' : '' }} select" required>
                        <option value="">{{ trans('global.select') }}</option>
                        {{$selectedvalue = $servicos->beneficiario_pessoa_id ?? null}}
                    @foreach($pessoas as $pessoa)
                        <option value="{{$pessoa->id}}" {{ $selectedvalue == $pessoa->id ? 'selected="selected"' : '' }}>{{ $pessoa->nome }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('beneficiario_pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('beneficiario_pessoa_id') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <a class="btn-md btn-blue rounded-md" href="{{ route('servicos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection