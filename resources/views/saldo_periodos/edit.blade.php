@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.saldo_periodo.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('saldo_periodos.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route("saldo_periodos.update", [$saldo_periodo->id]) }}">
        @method('PUT')
        @csrf
        <div class="body">
        <div class="mb-3">
                <label for="ano_exercicio" class="text-xs required">{{ trans('cruds.saldo_periodo.fields.ano_exercicio') }}</label>

                <div class="form-group">
                    <input type="text" readonly id="ano_exercicio" name="ano_exercicio" class="{{ $errors->has('ano_exercicio') ? ' is-invalid' : '' }}" value="{{ old('ano_exercicio', $saldo_periodo->ano_exercicio ?? date('Y')) }}" required>
                </div>
                @if($errors->has('ano_exercicio'))
                    <p class="invalid-feedback">{{ $errors->first('ano_exercicio') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="saldo_pesadas" class="text-xs required">{{ trans('cruds.saldo_periodo.fields.saldo_pesadas') }}</label>

                <div class="form-group">
                    <input type="number" id="saldo_pesadas" name="saldo_pesadas" class="{{ $errors->has('saldo_pesadas') ? ' is-invalid' : '' }}" value="{{ old('saldo_pesadas', $saldo_periodo->saldo_pesadas ?? 40) }}" required>
                </div>
                @if($errors->has('saldo_pesadas'))
                    <p class="invalid-feedback">{{ $errors->first('saldo_pesadas') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="saldo_leves" class="text-xs required">{{ trans('cruds.saldo_periodo.fields.saldo_leves') }}</label>

                <div class="form-group">
                    <input type="number" id="saldo_leves" name="saldo_leves" class="{{ $errors->has('saldo_leves') ? ' is-invalid' : '' }}" value="{{ old('saldo_leves', $saldo_periodo->saldo_leves ?? 10) }}" required>
                </div>
                @if($errors->has('saldo_leves'))
                    <p class="invalid-feedback">{{ $errors->first('saldo_leves') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="pessoa_nome" class="text-xs ">{{ trans('cruds.saldo_periodo.fields.pessoa_id') }}</label>

                <div class="form-group">
                    <input type="text" id="pessoa_nome" readonly name="pessoa_nome" class="{{ $errors->has('pessoa_nome') ? ' is-invalid' : '' }}" value="{{ old('pessoa_nome', $saldo_periodo->pessoa->nome ?? '') }}" required>
                </div>
                @if($errors->has('pessoa_nome'))
                    <p class="invalid-feedback">{{ $errors->first('pessoa_nome') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection