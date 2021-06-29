@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        Controle/Registro de Ponto
    </div>

    <div class="body">
        <div class="block pb-4">
        </div>
        <table class="striped bordered show-table ">
            <thead>
                <tr>
                    <th colspan="7">
                        <form method="POST" action="{{ route("ponto.index") }}">
                            @csrf
                            <div class="body">
                                <div class="mb-3">
                                    <label for="select_mes" class="text-xs required">Mês</label>

                                    <div class="form-group">
                                        <select type="select" id="select_mes" name="select_mes"  required>
                                            <option value ="01" {{($data['mes'] == '01') ? 'selected' : ''}}>Janeiro</option>
                                            <option value ="02" {{($data['mes'] == '02') ? 'selected' : ''}}>Fevereiro</option>
                                            <option value ="03" {{($data['mes'] == '03') ? 'selected' : ''}}>Março</option>
                                            <option value ="04" {{($data['mes'] == '04') ? 'selected' : ''}}>Abril</option>
                                            <option value ="05" {{($data['mes'] == '05') ? 'selected' : ''}}>Maio</option>
                                            <option value ="06" {{($data['mes'] == '06') ? 'selected' : ''}}>Junho</option>
                                            <option value ="07" {{($data['mes'] == '07') ? 'selected' : ''}}>Julho</option>
                                            <option value ="08" {{($data['mes'] == '08') ? 'selected' : ''}}>Agosto</option>
                                            <option value ="09" {{($data['mes'] == '09') ? 'selected' : ''}}>Setembro</option>
                                            <option value ="10" {{($data['mes'] == '10') ? 'selected' : ''}}>Outubro</option>
                                            <option value ="11" {{($data['mes'] == '11') ? 'selected' : ''}}>Novembro</option>
                                            <option value ="12" {{($data['mes'] == '12') ? 'selected' : ''}}>Dezembro</option>
                                        </select>
                                    </div>

                                    <label for="select_ano" class="text-xs required">Ano</label>

                                    <div class="form-group">
                                        <select type="select" id="select_ano" name="select_ano"  required>
                                            <option value ="2020" {{($data['ano'] == '2020') ? 'selected' : ''}}>2020</option>
                                            <option value ="2021" {{($data['ano'] == '2021') ? 'selected' : ''}}>2021</option>
                                            <option value ="2022" {{($data['ano'] == '2022') ? 'selected' : ''}}>2022</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded-full"> Buscar mês selecionado </button>   
                        </form>        
                    </th>
                </tr>
                <tr>
                    <th>Data</th>
                    <th>Turno 1 - Entrada</th>
                    <th>Turno 1 - Saída</th>
                    <th>Turno 2 - Entrada</th>
                    <th>Turno 2 - Saída</th>
                    <th>Tempo de almoço </th>
                    <th>Total trabalhado</th>
                </tr>
            </thead>
            <tbody class="form-group bg-gray-200">  
                <form method="POST" action="{{ route("ponto.store") }}">
                <input type="hidden" class="text-xs" name="mes" id="mes" value="{{$data['mes']}}">
                <input type="hidden" class="text-xs" name="ano" id="ano" value="{{$data['ano']}}">
                @csrf 
                @foreach(range(1,$data['ultimo_dia_mes']) as $dia) 
                    @php $ponto = null; @endphp
                    @foreach($pontos as $item)
                        @php
                        $ponto = ($item->data_ponto == str_pad($dia, 2, '0', STR_PAD_LEFT).'/'.$data['mes'].'/'.$data['ano']) ? $item : $ponto;
                        @endphp
                    @endforeach   
                <tr>
                    <td><input type="text" class="text-xs" name="dia_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{str_pad($dia, 2, '0', STR_PAD_LEFT)}}/{{$data['mes']}}/{{$data['ano']}}"></td>
                    <td><input type="text" class="text-xs tempo-valor hour-minute" onchange="calcula_tempos('{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}')" style="text-align:center;" placeholder="Entrada 1" name="turno_1_entrada_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="turno_1_entrada_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{$ponto->turno_1_entrada ?? ''}}"></td>
                    <td><input type="text" class="text-xs tempo-valor hour-minute" onchange="calcula_tempos('{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}')" style="text-align:center;" placeholder="Saída 1" name="turno_1_saida_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="turno_1_saida_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{$ponto->turno_1_saida ?? ''}}"></td>
                    <td><input type="text" class="text-xs tempo-valor hour-minute" onchange="calcula_tempos('{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}')" style="text-align:center;" placeholder="Entrada 2" name="turno_2_entrada_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="turno_2_entrada_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{$ponto->turno_2_entrada ?? ''}}"></td>
                    <td><input type="text" class="text-xs tempo-valor hour-minute" onchange="calcula_tempos('{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}')" style="text-align:center;" placeholder="Saída 2" name="turno_2_saida_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="turno_2_saida_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{$ponto->turno_2_saida ?? ''}}"></td>
                    <td><input readonly type="text" class="text-xs tempo-valor hour-minute" style="text-align:center;" placeholder="00:00" name="tempo_almoco_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="tempo_almoco_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{\App\Helpers\Helpers::convertFloattoHours(\App\Helpers\Helpers::convertHoursToFloat($ponto->turno_2_entrada ?? '00:00') - \App\Helpers\Helpers::convertHoursToFloat($ponto->turno_1_saida ?? '00:00'))}}"></td>
                    <td><input readonly type="text" class="text-xs tempo-valor hour-minute" style="text-align:center;" placeholder="00:00" name="total_trabalhado_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" id="total_trabalhado_{{str_pad($dia, 2, '0', STR_PAD_LEFT).$data['mes'].$data['ano']}}" value="{{\App\Helpers\Helpers::convertFloattoHours((\App\Helpers\Helpers::convertHoursToFloat($ponto->turno_1_saida ?? '00:00') -  \App\Helpers\Helpers::convertHoursToFloat($ponto->turno_1_entrada ?? '00:00')) + (\App\Helpers\Helpers::convertHoursToFloat($ponto->turno_2_saida ?? '00:00') -  \App\Helpers\Helpers::convertHoursToFloat($ponto->turno_2_entrada ?? '00:00')) )}}"></td>
                </tr>
                @endforeach
                <tr class="content-center">
                    <td colspan="7" >
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded-full"">{{ trans('global.save') }}</button>
                    </td>
                </tr>
                </form>
            </tbody>
            
        </table>
        
        
        <div class="block pt-4">
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    function calcula_tempos(dia){
        let total_dia = 0;
        let total_almoco = 0;
        let hora_entrada_manha = document.getElementById('turno_1_entrada_'+dia).value;
        let hora_saida_manha = document.getElementById('turno_1_saida_'+dia).value;
        let hora_entrada_tarde = document.getElementById('turno_2_entrada_'+dia).value;
        let hora_saida_tarde = document.getElementById('turno_2_saida_'+dia).value;
        if(hora_entrada_manha !== '' && hora_saida_manha !== ''){
            total_dia += convertHoursToFloat(hora_saida_manha) - convertHoursToFloat(hora_entrada_manha);
        }
        if(hora_entrada_tarde !== '' && hora_saida_tarde !== ''){
            total_dia += convertHoursToFloat(hora_saida_tarde) - convertHoursToFloat(hora_entrada_tarde);
        }
        if(hora_entrada_tarde !== '' && hora_saida_manha !== ''){
            total_almoco += convertHoursToFloat(hora_entrada_tarde) - convertHoursToFloat(hora_saida_manha);
        }
        document.getElementById('total_trabalhado_'+dia).value = convertFloattoHours(total_dia);
        document.getElementById('tempo_almoco_'+dia).value = convertFloattoHours(total_almoco);
    }
    // Formato esperado H:m
    function convertHoursToFloat(time)
    {
        
        let aux = time.split(':');
        let hours = aux[0];
        let minutes = aux[1];
        return parseFloat(hours) + parseFloat((minutes / 60).toFixed(2));

    }

    // Formato esperado 99.99
    function convertFloattoHours(time)
    {
        if(time > 0){
            time = time.toFixed(2);
            let aux = time.toString().split('.');
            let hours = aux[0].padStart(2, '0');
            let minutes = '00';
            if(aux[1] !== undefined){
                minutes = aux[1].padEnd(2, '0');
            }
            minutes = Math.round((((60 / 100) * minutes)).toString().padStart(2,'0'));
            return hours +':'+ minutes.toString().padStart(2,'0');
        }
        return 0;
        
    }
    
</script>
@endsection