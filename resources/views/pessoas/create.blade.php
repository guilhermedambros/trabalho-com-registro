@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.pessoa.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('pessoas.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route("pessoas.store") }}">
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="nome" class="text-xs required">{{ trans('cruds.pessoa.fields.nome') }}</label>

                <div class="form-group">
                    <input type="text" id="nome" name="nome" class="{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required>
                </div>
                @if($errors->has('nome'))
                    <p class="invalid-feedback">{{ $errors->first('nome') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="text-xs required">{{ trans('cruds.pessoa.fields.email') }}</label>

                <div class="form-group">
                    <input type="email" id="email" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                </div>
                @if($errors->has('email'))
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="documento" class="text-xs required">{{ trans('cruds.pessoa.fields.documento') }}</label>

                <div class="form-group">
                    <input type="documento" id="documento" name="documento" class="cpf {{ $errors->has('documento') ? ' is-invalid' : '' }}" value="{{ old('documento') }}" required>
                </div>
                @if($errors->has('documento'))
                    <p class="invalid-feedback">{{ $errors->first('documento') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="telefone" class="text-xs required">{{ trans('cruds.pessoa.fields.telefone') }}</label>

                <div class="form-group">
                    <input type="telefone" id="telefone" name="telefone" class=" phone {{ $errors->has('telefone') ? ' is-invalid' : '' }}" value="{{ old('telefone') }}" required>
                </div>
                @if($errors->has('telefone'))
                    <p class="invalid-feedback">{{ $errors->first('telefone') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="celular" class="text-xs">{{ trans('cruds.pessoa.fields.celular') }}</label>

                <div class="form-group">
                    <input type="celular" id="celular" name="celular" class="phone {{ $errors->has('celular') ? ' is-invalid' : '' }}" value="{{ old('celular') }}" >
                </div>
                @if($errors->has('celular'))
                    <p class="invalid-feedback">{{ $errors->first('celular') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo_pessoas" class="text-xs">{{ trans('cruds.pessoa.fields.tipo_pessoa') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn-sm btn-indigo select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn-sm btn-indigo deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="select2{{ $errors->has('tipo_pessoas') ? ' is-invalid' : '' }}" name="tipo_pessoas[]" id="tipo_pessoas" multiple>
                    @foreach($tipo_pessoas as $id => $tipo_pessoas)
                        <option value="{{ $id }}" {{ in_array($id, old('tipo_pessoas', [])) ? 'selected' : '' }}>{{ $tipo_pessoas }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_pessoa'))
                    <p class="invalid-feedback">{{ $errors->first('tipo_pessoa') }}</p>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="inscricao" class="text-xs">{{ trans('cruds.pessoa.fields.inscricao') }}</label>

                <div class="form-group">
                    <input type="inscricao" id="inscricao" name="inscricao" class="{{ $errors->has('inscricao') ? ' is-invalid' : '' }}" value="{{ old('inscricao', 366100) }}">
                </div>
                @if($errors->has('inscricao'))
                    <p class="invalid-feedback">{{ $errors->first('inscricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="cep" class="text-xs">{{ trans('cruds.pessoa.fields.cep') }}</label>

                <div class="form-group">
                    <input type="cep" id="cep" name="cep" class="cep {{ $errors->has('cep') ? ' is-invalid' : '' }}" value="{{ old('cep') }}">
                </div>
                @if($errors->has('cep'))
                    <p class="invalid-feedback">{{ $errors->first('cep') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="cidade" class="text-xs">{{ trans('cruds.pessoa.fields.cidade') }}</label>

                <div class="form-group">
                    <input type="cidade" id="cidade" name="cidade" class="{{ $errors->has('cidade') ? ' is-invalid' : '' }}" value="{{ old('cidade') }}">
                </div>
                @if($errors->has('cidade'))
                    <p class="invalid-feedback">{{ $errors->first('cidade') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="endereco" class="text-xs">{{ trans('cruds.pessoa.fields.endereco') }}</label>

                <div class="form-group">
                    <input type="endereco" id="endereco" name="endereco" class="{{ $errors->has('endereco') ? ' is-invalid' : '' }}" value="{{ old('endereco') }}">
                </div>
                @if($errors->has('endereco'))
                    <p class="invalid-feedback">{{ $errors->first('endereco') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="bairro" class="text-xs">{{ trans('cruds.pessoa.fields.bairro') }}</label>

                <div class="form-group">
                    <input type="bairro" id="bairro" name="bairro" class="{{ $errors->has('bairro') ? ' is-invalid' : '' }}" value="{{ old('bairro') }}">
                </div>
                @if($errors->has('bairro'))
                    <p class="invalid-feedback">{{ $errors->first('bairro') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="numero" class="text-xs">{{ trans('cruds.pessoa.fields.numero') }}</label>

                <div class="form-group">
                    <input type="numero" id="numero" name="numero" class="{{ $errors->has('numero') ? ' is-invalid' : '' }}" value="{{ old('numero') }}">
                </div>
                @if($errors->has('numero'))
                    <p class="invalid-feedback">{{ $errors->first('numero') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="complemento" class="text-xs">{{ trans('cruds.pessoa.fields.complemento') }}</label>

                <div class="form-group">
                    <input type="complemento" id="complemento" name="complemento" class="{{ $errors->has('complemento') ? ' is-invalid' : '' }}" value="{{ old('complemento') }}">
                </div>
                @if($errors->has('complemento'))
                    <p class="invalid-feedback">{{ $errors->first('complemento') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="text-xs">{{ trans('cruds.pessoa.fields.data_nascimento') }}</label>

                <div class="form-group">
                    <input type="data_nascimento" id="data_nascimento" name="data_nascimento" class="datepicker {{ $errors->has('data_nascimento') ? ' is-invalid' : '' }}" value="{{ old('data_nascimento') }}" autocomplete="off">
                </div>
                @if($errors->has('data_nascimento'))
                    <p class="invalid-feedback">{{ $errors->first('data_nascimento') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <a class="btn-md btn-blue rounded-md" href="{{ route('pessoas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection