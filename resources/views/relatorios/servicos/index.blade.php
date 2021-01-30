@extends('layouts.admin')
@section('content')

<div class="main-card">
    <div class="header">
        Relatório de serviços
    </div>

    <div class="body">
        <div class="w-full">
            <form method="POST" action="{{ route("relatorios.servicos.gerar") }}">
                @csrf
                <div class="body">
                    <div class="mb-3 grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1">
                        <div class="card m-4">
                            <label for="perio" class="text-xs required">De: </label>

                            <div class="form-group">
                                <input type="text" id="periodo_inicio" name="periodo_inicio" class=" date {{ $errors->has('periodo_inicio') ? ' is-invalid' : '' }}" value="{{ old('periodo_inicio')}}" required>
                            </div>
                            @if($errors->has('periodo_inicio'))
                                <p class="invalid-feedback">{{ $errors->first('periodo_inicio') }}</p>
                            @endif
                        </div>
                        <div class="card m-4">
                            <label for="periodo_fim" class="text-xs required">Até: </label>

                            <div class="form-group">
                                <input type="text" id="periodo_fim" name="periodo_fim" class=" date {{ $errors->has('periodo_fim') ? ' is-invalid' : '' }}" value="{{ old('periodo_fim')}}" required>
                            </div>
                            @if($errors->has('periodo_fim'))
                                <p class="invalid-feedback">{{ $errors->first('periodo_fim') }}</p>
                            @endif
                        </div>
                        <div class="card m-4">
                            <label for="pessoa" class="text-xs">{{ trans('cruds.saldo_periodo.fields.pessoa_id') }}</label>

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