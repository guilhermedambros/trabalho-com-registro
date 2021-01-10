@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.pessoa.title_singular') }}
    </div>

    <form method="POST" action="{{ route("pessoas.store") }}" enctype="multipart/form-data">
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
                    <input type="documento" id="documento" name="documento" class="{{ $errors->has('documento') ? ' is-invalid' : '' }}" value="{{ old('documento') }}" required>
                </div>
                @if($errors->has('documento'))
                    <p class="invalid-feedback">{{ $errors->first('documento') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="telefone" class="text-xs required">{{ trans('cruds.pessoa.fields.telefone') }}</label>

                <div class="form-group">
                    <input type="telefone" id="telefone" name="telefone" class="{{ $errors->has('telefone') ? ' is-invalid' : '' }}" value="{{ old('telefone') }}" required>
                </div>
                @if($errors->has('telefone'))
                    <p class="invalid-feedback">{{ $errors->first('telefone') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo_pessoa_id" class="text-xs required">{{ trans('cruds.pessoa.fields.tipo_pessoa') }}</label>

                <div class="form-group">
                    <select  id="tipo_pessoa_id" name="tipo_pessoa_id" class="{{ $errors->has('tipo_pessoa_id') ? ' is-invalid' : '' }}" required>
                        <option value="">{{ trans('global.select') }}</option>
                    @foreach($tipo_pessoas as $tipo_pessoa)
                        <option value="{{$tipo_pessoa->id}}">{{ $tipo_pessoa->descricao }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('tipo_pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('tipo_pessoa_id') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection