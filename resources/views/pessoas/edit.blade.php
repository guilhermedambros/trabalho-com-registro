@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.pessoa.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('pessoas.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route('pessoas.update', [$pessoa->id]) }}">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="nome" class="text-xs required">{{ trans('cruds.pessoa.fields.nome') }}</label>

                <div class="form-group">
                    <input type="text" id="nome" name="nome" class="{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome', $pessoa->nome) }}" required>
                </div>
                @if($errors->has('nome'))
                    <p class="invalid-feedback">{{ $errors->first('nome') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="text-xs">{{ trans('cruds.pessoa.fields.email') }}</label>

                <div class="form-group">
                    <input type="email" id="email" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $pessoa->email) }}" >
                </div>
                @if($errors->has('email'))
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="documento" class="text-xs">{{ trans('cruds.pessoa.fields.documento') }}</label>

                <div class="form-group">
                    <input type="documento" id="documento" name="documento" class="cpf {{ $errors->has('documento') ? ' is-invalid' : '' }}" value="{{ old('documento', $pessoa->documento) }}" >
                </div>
                @if($errors->has('documento'))
                    <p class="invalid-feedback">{{ $errors->first('documento') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="telefone" class="text-xs">{{ trans('cruds.pessoa.fields.telefone') }}</label>

                <div class="form-group">
                    <input type="telefone" id="telefone" name="telefone" class=" phone {{ $errors->has('telefone') ? ' is-invalid' : '' }}" value="{{ old('telefone', $pessoa->telefone) }}">
                </div>
                @if($errors->has('telefone'))
                    <p class="invalid-feedback">{{ $errors->first('telefone') }}</p>
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
                        <option value="{{ $id }}" {{ (in_array($id, old('tipo_pessoas', [])) || $pessoa->tipo_pessoas->contains($id)) ? 'selected' : '' }}>{{ $tipo_pessoas }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_pessoa'))
                    <p class="invalid-feedback">{{ $errors->first('tipo_pessoa') }}</p>
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