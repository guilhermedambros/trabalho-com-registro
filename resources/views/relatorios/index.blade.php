@extends('layouts.admin')
@section('content')
@can('demanda_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('demandas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.demanda.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.demanda.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
        <form method="POST" action="{{ route("relatorios.demandas.gerar") }}">
                @csrf
                <div class="body">
                    <div class="mb-3 grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                        <div class="card m-4">
                            <label for="mes" class="text-xs">Mês: </label>

                            <div class="form-group">
                                <select  id="mes" name="mes" class="{{ $errors->has('mes') ? ' is-invalid' : '' }} " >
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                </select>
                            </div>
                            @if($errors->has('mes'))
                                <p class="invalid-feedback">{{ $errors->first('mes') }}</p>
                            @endif
                        </div>
                        <div class="card m-4">
                            <label for="ano" class="text-xs required">Ano: </label>

                            <div class="form-group">
                                <select  id="ano" name="ano" class="{{ $errors->has('ano') ? ' is-invalid' : '' }} " required>
                                    @foreach($anos as $ano)
                                        <option value="{{$ano}}">{{ $ano }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('ano'))
                                <p class="invalid-feedback">{{ $errors->first('ano') }}</p>
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

@endsection