@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.tipo_maquina.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('tipo_maquinas.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route("tipo_maquinas.store") }}">
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.tipo_maquina.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="valor_hora_subsidiado" class="text-xs required">{{ trans('cruds.tipo_maquina.fields.valor_hora_subsidiado') }}</label>

                <div class="form-group">
                    <input type="valor_hora_subsidiado" id="valor_hora_subsidiado" name="valor_hora_subsidiado" class="money {{ $errors->has('valor_hora_subsidiado') ? ' is-invalid' : '' }}" value="{{ old('valor_hora_subsidiado') }}" required>
                </div>
                @if($errors->has('valor_hora_subsidiado'))
                    <p class="invalid-feedback">{{ $errors->first('valor_hora_subsidiado') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection