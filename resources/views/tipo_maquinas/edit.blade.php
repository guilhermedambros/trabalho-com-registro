@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.tipo_maquina.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('tipo_maquinas.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route('tipo_maquinas.update', [$tipo_maquina->id]) }}">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.tipo_maquina.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao', $tipo_maquina->descricao) }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
                <span class="block">{{ trans('cruds.tipo_maquina.fields.descricao') }}</span>
            </div>
            <div class="mb-3">
                <label for="valor_hora_subsidiado" class="text-xs required">{{ trans('cruds.tipo_maquina.fields.valor_hora_subsidiado') }}</label>

                <div class="form-group">
                    <input type="valor_hora_subsidiado" id="valor_hora_subsidiado" name="valor_hora_subsidiado" class="money {{ $errors->has('valor_hora_subsidiado') ? ' is-invalid' : '' }}" value="{{ old('valor_hora_subsidiado', $tipo_maquina->valor_hora_subsidiado) }}" required>
                </div>
                @if($errors->has('valor_hora_subsidiado'))
                    <p class="invalid-feedback">{{ $errors->first('valor_hora_subsidiado') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo_bonificacao" class="text-xs required">{{ trans('cruds.tipo_maquina.fields.tipo_bonificacao') }}</label>

                <div class="form-group">
                <select  id="tipo_bonificacao" name="tipo_bonificacao" class="{{ $errors->has('tipo_bonificacao') ? ' is-invalid' : '' }} select" required>
                    <option value="">{{ trans('global.select') }}</option>
                        @php $selected_value = $tipo_maquina->tipo_bonificacao ?? 0; @endphp
               
                        @foreach($tipos_bonificacao as $key => $value)
                            <option value="{{$key}}" {{($selected_value == $key) ? 'selected' : ''}}>{{ $value }}</option>
                        @endforeach
                </select>
                </div>
                @if($errors->has('tipo_bonificacao'))
                    <p class="invalid-feedback">{{ $errors->first('tipo_bonificacao') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <a class="btn-md btn-blue rounded-md" href="{{ route('tipo_maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection