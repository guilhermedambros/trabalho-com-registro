@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.servico.title_singular') }}
    </div>

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
            <div id="div-maquinas" class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                <div class="w-full px-2 md:w-1/4">
                    <label class="text-xs" for="pivot.maquina">Máquina</label>
                    <select class="id-maquinas w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" name="pivot.maquina_id[]">
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
                    <label class="text-xs" for="pivot.valor">Tempo</label>
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline number" type="text" id="tempo" name="pivot.tempo[]" />
                </div>
                <div class="w-full px-2 md:w-1/4">
                    <label class="text-xs" for="formGridCode_last">Valor</label>
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline money" type="text" id="valor" name="pivot.valor[]" />
                </div>
                <div class="w-full md:w-1/4">
                    <button id="remove-field" type="button" class="remove-field btn-md mt-6 btn-red rounded-md">Remover Máquina</button>
                </div>
            </div>
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
                        if (document.querySelectorAll('.id-maquinas').length < optionsLength && optionsLength < 2) {
                            newDiv.appendChild(newSelect);
                            newSelect.childNodes[1].childNodes[3].childNodes[1].remove();
                            document.querySelectorAll('.id-maquinas').forEach((key,val) => {
                                newSelect.childNodes[1].childNodes[3].options[key.selectedIndex] = null;
                            });
                            document.getElementById('servicos').appendChild(newDiv);
                        }
                    } else {
                        if (document.querySelectorAll('.id-maquinas').length < optionsLength) {
                            newDiv.appendChild(newSelect);
                            newSelect.childNodes[5].childNodes[1].childNodes[1].remove();
                            document.querySelectorAll('.id-maquinas').forEach((key,val) => {
                                newSelect.childNodes[1].childNodes[3].options[key.selectedIndex] = null;
                            });
                            document.getElementById('maquinas').appendChild(newDiv);
                        }
                    }
                }
            };

            document.addEventListener('click',function(e) {
                if (e.target && e.target.classList.contains('number')) {
                    VMasker(document.querySelectorAll(".number")).maskNumber();
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