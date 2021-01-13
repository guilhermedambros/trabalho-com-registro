@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.servico.title_singular') }}
    </div>

    <form method="POST" action="{{ route($routes, old('id') ?? $servico->id ?? null) }}" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.servico.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_realizacao" class="text-xs required">{{ trans('cruds.servico.fields.data_realizacao') }}</label>

                <div class="form-group">
                    <input type="text" id="data_realizacao" name="data_realizacao" class="{{ $errors->has('data_realizacao') ? ' is-invalid' : '' }} date" value="{{ old('data_realizacao') }}" required>
                </div>
                @if($errors->has('data_realizacao'))
                    <p class="invalid-feedback">{{ $errors->first('data_realizacao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="pessoa_id" class="text-xs required">{{ trans('cruds.servico.fields.pessoa_id') }}</label>

                <div class="form-group">
                    <select  id="pessoa_id" name="pessoa_id" class="{{ $errors->has('pessoa_id') ? ' is-invalid' : '' }} select" required>
                        <option value="">{{ trans('global.select') }}</option>
                    @foreach($pessoas as $pessoa)
                        <option value="{{$pessoa->id}}">{{ $pessoa->nome }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('pessoa_id') }}</p>
                @endif
            </div>
            
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection