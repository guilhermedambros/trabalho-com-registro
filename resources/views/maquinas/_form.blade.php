@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.maquina.title_singular') }}
    </div>

    <form method="POST" action="{{ route($routes, old('id') ?? $maquinas['id'] ?? null) }}" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.maquina.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') ?? $maquinas['descricao'] ?? null }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('maquinas->descricao') }}</p>
                @endif
            </div>
            

            <div class="mb-3">
                <label for="valor_hora" class="number-xs required">{{ trans('cruds.maquina.fields.valor_hora') }}</label>

                <div class="form-group">
                    <input type="money" id="valor_hora" name="valor_hora" class="money text" value="$maquinas['valor_hora]'" required>
                </div>
                @if($errors->has('valor_hora'))
                    <p class="invalid-feedback">{{ $errors->first('valor_hora') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="tipo_maquina_id" class="text-xs required">{{ trans('cruds.maquina.fields.tipo_maquina') }}</label>

                <div class="form-group">
                    <select  id="tipo_maquina_id" name="tipo_maquina_id" class="{{ $errors->has('tipo_maquina_id') ? ' is-invalid' : '' }} select" required>
                        <option value="">{{ trans('global.select') }}</option>
                        {{$selectedvalue = $maquina->tipo_maquina_id ?? null}}
                    @foreach($maquinas as $maquina)
                        <option value="{{$tipo_maquinas['id']}}" {{ $selectedvalue == $maquina->id ? 'selected="selected"' : '' }}>{{ $maquina->descricao }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('tipo_maquina_id'))
                    <p class="invalid-feedback">{{ $errors->first('tipo_maquina_id') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <a class="btn-md btn-blue rounded-md" href="{{ route('maquinas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@parent
<script>
    public function passes($attribute, $value){
    // verifica se está no formato 9.999.999.999,99 e quantos milhares forem necessários.
    $expressao = "/^([1-9]{1}[\d]{0,2}(\.[\d]{3})*(\,[\d]{0,2})?|[1-9]{1}[\d]{0,}(\,[\d]{0,2})?|0(\,[\d]{0,2})?|(\,[\d]{1,2})?)$/";
    return (preg_match($expressao,$value));
  }
</script>
@endsection