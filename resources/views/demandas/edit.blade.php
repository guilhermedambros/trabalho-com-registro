@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.demanda.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('demandas.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route('demandas.update', [$demanda->id]) }}">
        @method('PUT')
        @csrf
        <div class="body">
        <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.demanda.fields.descricao') }}</label>

                <div class="form-group">
                    <textarea type="text" rows="7" id="descricao" name="descricao" class=" resize border rounded-md w-full {{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') }}" required>
                    {{old('descricao', $demanda->descricao) ?? ''}}
                    </textarea>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="pessoa_id" class="text-xs required">{{ trans('cruds.demanda.fields.pessoa_id') }}</label>

                <div class="form-group">
                    <select  id="pessoa_id" name="pessoa_id" class="{{ $errors->has('pessoa_id') ? ' is-invalid' : '' }} select">
                        <option value="">{{ trans('global.select') }}</option>
                        @php $selected_value =  old('pessoa_id', $demanda->pessoa_id); @endphp
                        @foreach($pessoas as $pessoa)
                        <option value="{{$pessoa->id}}" {{($selected_value == $demanda->pessoa_id) ? 'selected' : ''}}>{{ $pessoa->nome }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('pessoa_id') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="valor_hora" class="text-xs required">{{ trans('cruds.demanda.fields.valor_hora') }}</label>

                <div class="form-group">
                    <input type="valor_hora" id="valor_hora" required name="valor_hora" class="money {{ $errors->has('valor_hora') ? ' is-invalid' : '' }}" value="{{ old('valor_hora', $demanda->valor_hora) }}">
                </div>
                @if($errors->has('valor_hora'))
                    <p class="invalid-feedback">{{ $errors->first('valor_hora') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_inicio" class="text-xs required">{{ trans('cruds.demanda.fields.data_inicio') }}</label>

                <div class="form-group">
                    <input type="data_inicio" autocomplete="off" id="data_inicio" required name="data_inicio" class="datepicker {{ $errors->has('data_inicio') ? ' is-invalid' : '' }}" value="{{ old('data_inicio', $demanda->data_inicio) }}">
                </div>
                @if($errors->has('data_inicio'))
                    <p class="invalid-feedback">{{ $errors->first('data_inicio') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_entrega" class="text-xs">{{ trans('cruds.demanda.fields.data_entrega') }}</label>

                <div class="form-group">
                    <input type="data_entrega" autocomplete="off" id="data_entrega" name="data_entrega" class=" datepicker {{ $errors->has('data_entrega') ? ' is-invalid' : '' }}" value="{{ old('data_entrega', $demanda->data_entrega) }}">
                </div>
                @if($errors->has('data_entrega'))
                    <p class="invalid-feedback">{{ $errors->first('data_entrega') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_prazo" class="text-xs">{{ trans('cruds.demanda.fields.data_prazo') }}</label>

                <div class="form-group">
                    <input type="data_prazo" autocomplete="off" id="data_prazo" name="data_prazo" class=" datepicker {{ $errors->has('data_prazo') ? ' is-invalid' : '' }}" value="{{ old('data_prazo', $demanda->data_prazo) }}">
                </div>
                @if($errors->has('data_prazo'))
                    <p class="invalid-feedback">{{ $errors->first('data_prazo') }}</p>
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