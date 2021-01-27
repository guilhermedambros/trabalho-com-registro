@extends('layouts.admin')
@section('content')

<div class="main-card">
    <div class="header">
        Relatório de saldos
    </div>

    <div class="body">
        <div class="w-full">
            <form method="POST" action="{{ route("relatorios.saldos.gerar") }}">
                @csrf
                <div class="body">
                    <div class="mb-3">
                        <label for="ano_exercicio" class="text-xs required">{{ trans('cruds.saldo_periodo.fields.ano_exercicio') }}</label>

                        <div class="form-group">
                            <select  id="ano_exercicio" name="ano_exercicio" class="{{ $errors->has('ano_exercicio') ? ' is-invalid' : '' }} select" required>
                                <option value="">{{ trans('global.select') }}</option>
                            @foreach($periodos as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                            @endforeach
                            </select>
                        </div>
                        @if($errors->has('ano_exercicio'))
                            <p class="invalid-feedback">{{ $errors->first('ano_exercicio') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="pessoa" class="text-xs">{{ trans('cruds.saldo_periodo.fields.pessoa') }}</label>

                        <div class="form-group">
                            <select  id="pessoa" name="pessoa" class="{{ $errors->has('pessoa') ? ' is-invalid' : '' }} " >
                                <option value="">Todos</option>
                            @foreach($pessoas as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                            @endforeach
                            </select>
                        </div>
                        @if($errors->has('pessoa'))
                            <p class="invalid-feedback">{{ $errors->first('pessoa') }}</p>
                        @endif
                    </div>                   
                    
                </div>

                <div class="footer">
                    <button type="submit" class="submit-button ">Gerar o relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
  

</script>
@endsection