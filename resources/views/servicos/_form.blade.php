@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ $title }} {{ trans('cruds.servico.title_singular') }}
    </div>

    @error('message')
        <div class="alert alert-danger">
            <strong>{{ session('errors')->first('message') }}</strong>
        </div>
    @enderror

    <form method="POST" action="{{ route($routes, old('id') ?? $servicos->id ?? null) }}" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div id="servicos" class="body">
            <div class="mb-3">
                <label for="descricao" class="text-xs required">{{ trans('cruds.servico.fields.descricao') }}</label>

                <div class="form-group">
                    <input type="text" id="descricao" name="descricao" class="{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ old('descricao') ?? $servicos->descricao ?? null }}" required>
                </div>
                @if($errors->has('descricao'))
                    <p class="invalid-feedback">{{ $errors->first('descricao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="endereco" class="text-xs required">{{ trans('cruds.servico.fields.endereco') }}</label>

                <div class="form-group">
                    <input type="text" id="endereco" name="endereco" class="{{ $errors->has('endereco') ? ' is-invalid' : '' }}" value="{{ old('endereco') ?? $servicos->endereco ?? null }}" required>
                </div>
                @if($errors->has('endereco'))
                    <p class="invalid-feedback">{{ $errors->first('endereco') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="data_realizacao" class="text-xs required">{{ trans('cruds.servico.fields.data_realizacao') }}</label>

                <div class="form-group">
                    <input type="text" id="data_realizacao" name="data_realizacao" class="{{ $errors->has('data_realizacao') ? ' is-invalid' : '' }} date" value="{{ old('data_realizacao') ?? $servicos->data_realizacao ?? null }}" required>
                </div>
                @if($errors->has('data_realizacao'))
                    <p class="invalid-feedback">{{ $errors->first('data_realizacao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="numero" class="text-xs required">{{ trans('cruds.servico.fields.numero') }}</label>

                <div class="form-group">
                    <input type="text" id="numero" name="numero" class="{{ $errors->has('numero') ? ' is-invalid' : '' }}" value="{{ old('numero') ?? $servicos->numero ?? null }}" required>
                </div>
                @if($errors->has('data_realizacao'))
                    <p class="invalid-feedback">{{ $errors->first('data_realizacao') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="beneficiario_pessoa_id" class="text-xs required">{{ trans('cruds.servico.fields.beneficiario_pessoa_id') }}</label>

                <div class="form-group">
                    <select  id="beneficiario_pessoa_id" name="beneficiario_pessoa_id" class="{{ $errors->has('beneficiario_pessoa_id') ? ' is-invalid' : '' }} select" required>
                        <option value="">{{ trans('global.select') }}</option>
                        {{$selectedvalue = $servicos->beneficiario_pessoa_id ?? null}}
                    @foreach($pessoas as $pessoa)
                        <option value="{{$pessoa->id}}" {{ $selectedvalue == $pessoa->id ? 'selected="selected"' : '' }}>{{ $pessoa->nome }}</option>
                    @endforeach
                    </select>
                </div>
                @if($errors->has('beneficiario_pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('beneficiario_pessoa_id') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <button id="add-field" type="button" class="add-field btn-md mt-6 btn-blue rounded-md">Adicionar Máquina</button>
            </div>
            @if (isset($servicos->maquinas))
                @foreach ($servicos->maquinas as $maquina)
                    @php $tempo = $maquina['pivot']['tempo'] @endphp
                    @php $valor = $maquina['pivot']['valor_total'] @endphp
                    <div id="div-maquinas" class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                        <div class="w-full px-2 md:w-1/4">
                            <label class="text-xs" for="pivot.maquina">Máquina</label>
                            <select class="id-maquinas w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" name="pivot.maquina_id[]" required>
                                {{$selectedvalue = $maquina->id}}
                                <option value=""></option>
                                @foreach ($maquinas as $key => $maquina)
                                    <option value="{{ $maquina->id }}" {{ $selectedvalue == $maquina->id ? 'selected="selected"' : '' }}>
                                        {{ $maquina->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full px-2 md:w-1/4">
                            <label class="text-xs" for="pivot.valor_total">Tempo (h:m)</label>
                            <input class="tempo-valor w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline hour-minute" type="text" id="tempo" name="pivot.tempo[]" value="{{\App\Helpers\Helpers::convertFloattoHours($tempo)}}" required />
                        </div>
                        <div class="w-full px-2 md:w-1/4">
                            <label class="text-xs" for="formGridCode_last">Valor (R$)</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" id="valor" name="pivot.valor_total[]" value="{{number_format($valor, 2, ',', '.')}}" readonly="readonly" />
                        </div>
                        <div class="w-full md:w-1/4">
                            <button id="remove-field" type="button" class="remove-field btn-md mt-6 btn-red rounded-md">Remover Máquina</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div id="div-maquinas" class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                    <div class="w-full px-2 md:w-1/4">
                        <label class="text-xs" for="pivot.maquina">Máquina</label>
                        <select class="id-maquinas w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" name="pivot.maquina_id[]" required>
                            {{$selectedvalue = null}}
                            <option value=""></option>
                            @foreach ($maquinas as $key => $maquina)
                                <option value="{{ $maquina->id }}" {{ $selectedvalue == $maquina->id ? 'selected="selected"' : '' }}>
                                    {{ $maquina->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full px-2 md:w-1/4">
                        <label class="text-xs" for="pivot.tempo">Tempo (h:m)</label>
                        <input class="tempo-valor w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline hour-minute" type="text" id="tempo" name="pivot.tempo[]" required />
                    </div>
                    <div class="w-full px-2 md:w-1/4">
                        <label class="text-xs" for="pivot.valor_total">Valor (R$)</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" id="valor" name="pivot.valor_total[]" readonly="readonly" />
                    </div>
                    <div class="w-full md:w-1/4">
                        <button id="remove-field" type="button" class="remove-field btn-md mt-6 btn-red rounded-md">Remover Máquina</button>
                    </div>
                </div>
            @endif
        </div>

        <div class="footer">
            <a class="btn-md btn-blue rounded-md" href="{{ route('servicos.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        let divGeral = document.getElementById('div-maquinas');
        let newDivGeral = document.createElement('div');
        let newSelectGeral = divGeral.cloneNode(true);
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.addEventListener('DOMContentLoaded', function() {
            const optionsLength = document.querySelector('.id-maquinas').options.length;
            document.getElementById('add-field').onclick = function() {
                if (document.querySelectorAll('.remove-field').length < 1) {
                    newDivGeral.appendChild(newSelectGeral);
                    document.getElementById('servicos').appendChild(newDivGeral);
                } else {
                    let div = document.getElementById('div-maquinas');
                    let newDiv = document.createElement('div');
                    let newSelect = div.cloneNode(true);
                    if (newSelect.childNodes.length == 9) {
                        if (document.querySelectorAll('.id-maquinas').length < optionsLength-1) {
                            newDiv.appendChild(newSelect);
                            document.getElementById('servicos').appendChild(newDiv);
                        }
                    } else {
                        if (document.querySelectorAll('.id-maquinas').length < optionsLength-1) {
                            newDiv.appendChild(newSelect);
                            document.getElementById('maquinas').appendChild(newDiv);
                        }
                    }
                }
            };

            const on = (selector, eventType, childSelector, eventHandler) => {
                const elements = document.querySelectorAll(selector)
                for (element of elements) {
                    element.addEventListener(eventType, eventOnElement => {
                        if (eventOnElement.target.matches(childSelector)) {
                            eventHandler(eventOnElement)
                        }
                    })
                }
            }

            $(document).on('click', '.id-maquinas', function(e) {
                $(this).on('change', function(event) {
                    let tempo = this.parentElement.parentElement.childNodes[3].childNodes[3]
                    let valor = this.parentElement.parentElement.childNodes[5].childNodes[3]
                    if (tempo.value) {
                        fetch(`{{route('maquinas.get_valor_hora')}}`, {
                            method: 'post',
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({
                                id: this.value,
                                tempo: tempo.value,
                                data_realizacao: document.getElementById('data_realizacao').value
                            })
                        })
                        .then(function(resp) {
                            return resp.json();
                        })
                        .then(function(resp) {
                            if (resp) {
                                valor.value = resp['data']
                            }
                            return resp;
                        })
                        .catch(function(error) {
                            console.log(error);
                        })
                    }
                })
            })

            $(document).on('keyup', '.tempo-valor', function(e) {
                let id = this.parentElement.parentElement.childNodes[1].childNodes[3]
                let valor = this.parentElement.parentElement.childNodes[5].childNodes[3]
                if (id.value && e.target.value.length > 4) {
                    let tempo = this.value.substring(0,5)
                    console.log(tempo)
                    fetch(`{{route('maquinas.get_valor_hora')}}`, {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            id: id.value,
                            tempo: tempo,
                            data_realizacao: document.getElementById('data_realizacao').value
                        })
                    })
                    .then(function(resp) {
                        return resp.json();
                    })
                    .then(function(resp) {
                        console.log(resp)
                        if (resp) {
                            if (resp['success'] == false) {
                                alertify.alert('Informação', resp['data'])
                                valor.value = ''
                            } else {
                                valor.value = resp['data']
                            }
                        }
                        return resp;
                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                }
            })

            document.addEventListener('click',function(e) {
                if (e.target && e.target.classList.contains('number')) {
                    VMasker(document.querySelectorAll(".number")).maskNumber();
                }

                if (e.target && e.target.classList.contains('hour-minute')) {
                    VMasker(document.querySelectorAll('.hour-minute')).maskPattern('99:99');
                }

                if (e.target && e.target.classList.contains('money')) {
                    VMasker(document.querySelectorAll(".money")).maskMoney({
                        precision: 2,
                        separator: ',',
                        delimiter: '.',
                        unit: '',
                        zeroCents: false
                    });
                }

                if (e.target && e.target.classList.contains('remove-field')) {
                    e.target.parentElement.parentElement.remove();
                }
            });
        })
    </script>
@endsection