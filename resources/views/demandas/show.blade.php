@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.demanda.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('demandas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.id') }}
                    </th>
                    <td>
                        {{ $demanda->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.descricao') }}
                    </th>
                    <td>
                        {{ $demanda->descricao }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.valor_hora') }}
                    </th>
                    <td>
                        {{ $demanda->valor_hora ?? ''}}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.pessoa_id') }}
                    </th>
                    <td>
                        {{ $demanda->pessoa->nome ?? ''}}
                    </td>
                </tr>
               <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.data_inicio') }}
                    </th>
                    <td>
                        {{ $demanda->data_inicio ?? '' }}
                    </td>
                </tr>
                
                              
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.data_entrega') }}
                    </th>
                    <td>
                        {{ $demanda->data_entrega ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.data_prazo') }}
                    </th>
                    <td>
                        {{ $demanda->data_prazo ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.created_at') }}
                    </th>
                    <td>
                        {{ (isset($demanda->created_at)) ? date("d/m/Y", strtotime($demanda->created_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.updated_at') }}
                    </th>
                    <td>
                        {{ (isset($demanda->updated_at)) ? date("d/m/Y", strtotime($demanda->updated_at)) : '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.demanda.fields.deleted_at') }}
                    </th>
                    <td>
                        {{ $demanda->deleted_at ?? 'Não excluído' }}
                    </td>
                </tr>
                
            </tbody>
        </table>
        <table class=" border-solid border-2 border-black striped bordered show-table">
            <thead>
                <tr><th colspan="4"  class="content-center border-solid border-2 border-black">Lista de atendimentos</th></tr>
                <tr>
                    <th class=" border-solid border-2 border-black">{{ trans('cruds.registro.fields.data_registro') }}</th>
                    <th class=" border-solid border-2 border-black">{{ trans('cruds.registro.fields.descricao') }}</th>
                    <th class=" border-solid border-2 border-black">{{ trans('cruds.registro.fields.tempo') }}</th>
                    <th class=" border-solid border-2 border-black">{{ trans('cruds.registro.fields.user_id') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $total_tempo = 0; @endphp
                @foreach($demanda->registros as $registro)
                <tr>
                    <td class=" border-solid border-2 border-black">{{$registro->data_registro}}</td>
                    <td class=" border-solid border-2 border-black">{{$registro->descricao}}</td>
                    <td class=" border-solid border-2 border-black">{{App\Helpers\Helpers::convertFloatToHours($registro->tempo)}}</td>
                    <td class=" border-solid border-2 border-black">{{$registro->atendente->name ?? ''}}</td>
                </tr>
                @php $total_tempo += $registro->tempo; @endphp
                @endforeach
            </tbody>
            <tfooter>
                <tr>
                    <th class=" border-solid border-2 border-black" colspan="2">Total</th>
                    <th class=" border-solid border-2 border-black">{{App\Helpers\Helpers::convertFloatToHours($total_tempo)}}</th>
                    <th class=" border-solid border-2 border-black"></th>
                </tr>
            </tfooter>
        </table>
        <form method="POST" action="{{ route("registros.store", $demanda->id) }}">
            @csrf
            <div class="body">
                <div class="mb-3">
                    <label for="descricao" class="text-xs required">{{ trans('cruds.registro.fields.descricao') }}</label>

                    <div class="form-group">
                        <textarea type="text" rows="7" id="descricao" name="descricao" class=" resize border rounded-md w-full {{ $errors->has('descricao') ? ' is-invalid' : '' }}" required>{{old('descricao') ?? ''}}</textarea>
                    </div>
                    @if($errors->has('descricao'))
                        <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="data_registro" class="text-xs required">{{ trans('cruds.registro.fields.data_registro') }}</label>

                    <div class="form-group">
                        <input type="data_registro" autocomplete="off" id="data_registro" required name="data_registro" class="datepicker {{ $errors->has('data_registro') ? ' is-invalid' : '' }}" value="{{ old('data_registro') }}">
                    </div>
                    @if($errors->has('data_registro'))
                        <p class="invalid-feedback">{{ $errors->first('data_registro') }}</p>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="tempo" class="text-xs required">{{ trans('cruds.registro.fields.tempo') }}</label>

                    <div class="form-group">
                        <input type="tempo" autocomplete="off" id="tempo" required name="tempo" class="tempo-valor hour-minute {{ $errors->has('tempo') ? ' is-invalid' : '' }}" value="{{ old('tempo') }}">
                    </div>
                    @if($errors->has('tempo'))
                        <p class="invalid-feedback">{{ $errors->first('tempo') }}</p>
                    @endif
                </div>
                

            <div class="footer">
                <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
            </div>
        </form>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('demandas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection