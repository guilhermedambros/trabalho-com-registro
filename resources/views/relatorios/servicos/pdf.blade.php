<!DOCTYPE html>
<html>
<head>

<style>
        
        .center {text-align: center;}
        .left {text-align: left;}
        .right {text-align: right;}
        .bold {font-weight: bold;}
        .table-head{font-size: 11px;}
        .table-body{font-size: 10px;}
        .font9{font-size: 9px;}
        .font8{font-size: 8px;}
        .font7{font-size: 7px;}
        .font12{font-size: 12px;}
        tr.head{background-color: #B6B6B6;}
        tr.body{background-color: #E1E1E1;}
        .border {
        border-collapse: collapse !important;
        }
        .border-botton{
            border-bottom: 1px solid;
        }
        .bLeft{
            border-left: 1px solid;
        }
        fieldset{
        padding: 6px !important;
        margin: 3px !important;
        font-family: Helvetica, sans-serif;
        }
        .helvetica{
        font-family: Helvetica, sans-serif;
        }
        .quebrapagina {
        page-break-before: always;
        page-break-inside:avoid;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    
    <title>Relatório de serviçoes realizados no período de {{$request->periodo_inicio}} até {{$request->periodo_fim}}</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr class="text-center h4">
                <td colspan="12" style="border: 0 !important;">ASSOCIAÇÃO DE DESENVOLVIMENTO AGRÍCOLA DE LINHA NOVA</td>
            </tr>
            <tr class="text-center h5">
                <td colspan="12" style="border: 0 !important;">RELATÓRIO DA PRESTAÇÃO DE SERVIÇOS PELO CÍRCULO DE MÁQUINAS </td>
            </tr>
            <tr class="text-center h6">
                <td colspan="12"  style="border: 0 !important;">Período: {{$request->periodo_inicio}} até {{$request->periodo_fim}}</td>
            </tr>
            <tr class="h6 border">
                <th class="border" style="font-size: x-small;" scope="col">Nome do beneficiario</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Talão</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Local</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Nº Contr</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Prestador</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Maquina Utilizada</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Data serviço</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Valor p/ hora</th>
                <th class="border"  style="font-size: x-small;"  scope="col">horas</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Valor total do serviço</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Valor PG Produtor</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Valor Subsídio</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total_horas = 0;
                $total_servico = 0;
                $total_produtor = 0;
                $total_subsidio = 0;
            @endphp
            @foreach($servicos as $servico)
                @if(count($servico->maquinas) > 0)
                    @foreach($servico->maquinas as $maquina)
            <tr>
                <td class="border"  style="font-size: x-small;">{{$servico->beneficiario->nome ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->beneficiario->inscricao ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->endereco ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->numero ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$maquina->proprietario->nome ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$maquina->descricao ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->data_realizacao ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{ number_format($maquina->valor_hora, 2, ',', '.') }}</td>
                <td class="border"  style="font-size: x-small;">{{ \App\Helpers\Helpers::convertFloattoHours($maquina->pivot->tempo)}} </td>
                <td class="border"  style="font-size: x-small;">{{ number_format($maquina->pivot->valor_total, 2, ',', '.') }}</td>
                <td class="border"  style="font-size: x-small;">{{ number_format($maquina->pivot->valor_total - $maquina->pivot->valor_subsidiado, 2, ',', '.') }}</td>
                <td class="border"  style="font-size: x-small;">{{ number_format($maquina->pivot->valor_subsidiado, 2, ',', '.') }}</td>
                @php 
                    
                    $totais[$maquina->proprietario->id]['nome'] = $totais[$maquina->proprietario->id]['nome'] ?? $maquina->proprietario->nome;
                    $totais[$maquina->proprietario->id]['percentual_issqn'] = $totais[$maquina->proprietario->id]['percentual_issqn'] ?? $maquina->proprietario->issqn;
                    $totais[$maquina->proprietario->id]['valor_issqn'] = $maquina->pivot->valor_issqn + ($totais[$maquina->proprietario->id]['valor_issqn'] ?? 0);
                    $totais[$maquina->proprietario->id]['horas'] = $maquina->pivot->tempo + ($totais[$maquina->proprietario->id]['horas'] ?? 0);
                    $totais[$maquina->proprietario->id]['valor_total'] = $maquina->pivot->valor_total + ($totais[$maquina->proprietario->id]['valor_total'] ?? 0);
                    $totais[$maquina->proprietario->id]['valor_pago_produtor'] = ($maquina->pivot->valor_total - $maquina->pivot->valor_subsidiado) + ($totais[$maquina->proprietario->id]['valor_pago_produtor'] ?? 0);
                    $totais[$maquina->proprietario->id]['valor_subsidio'] = $maquina->pivot->valor_subsidiado + ($totais[$maquina->proprietario->id]['valor_subsidio'] ?? 0);
                    $total_horas += $maquina->pivot->tempo;
                    $total_servico += $maquina->pivot->valor_total;
                    $total_produtor += ($maquina->pivot->valor_total - $maquina->pivot->valor_subsidiado);
                    $total_subsidio += $maquina->pivot->valor_subsidiado;
                @endphp
            </tr>
                    @endforeach
                @else
            <tr>
                <td class="border"  style="font-size: x-small;">{{$servico->beneficiario->nome ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->beneficiario->inscricao ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->endereco ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$servico->numero ?? ''}}</td>
                <td class="border"  style="font-size: x-small;" colspan="8">Nenhuma máquina cadastrada</td>
            </tr>
                @endif
            @endforeach
            <tr>
                <th class="border"  colspan="8" style="font-size: x-small;">Valor total</th>
                <th class="border"  style="font-size: x-small;">{{ \App\Helpers\Helpers::convertFloattoHours($total_horas)}} </th>
                <th class="border"  style="font-size: x-small;">{{ number_format($total_servico, 2, ',', '.') }}</th>
                <th class="border"  style="font-size: x-small;">{{ number_format($total_produtor, 2, ',', '.') }}</th>
                <th class="border"  style="font-size: x-small;">{{ number_format($total_subsidio, 2, ',', '.') }}</th></tr>
        </tbody>
    </table>
    <table class="table table-striped quebrapagina">
        <thead>
            <tr class="h6 border">
                <th class="border" style="font-size: x-small;" scope="col">Prestador</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Horas trabalhadas</th>
                <th class="border"  style="font-size: x-small;"  scope="col">R$ Valor total do serviço</th>
                <th class="border"  style="font-size: x-small;"  scope="col">R$ Valor PG produtor</th>
                <th class="border"  style="font-size: x-small;"  scope="col">R$ Valor subsídio</th>
                <th class="border"  style="font-size: x-small;"  scope="col">ISSNQN %</th>
                <th class="border"  style="font-size: x-small;"  scope="col">R$ V.Liquido repasse ISSQN</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($totais))
                @foreach($totais as $item)
            <tr>
                <td class="border"  style="font-size: x-small;">{{$item['nome'] ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{\App\Helpers\Helpers::convertFloattoHours($item['horas']) ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">R$ {{number_format($item['valor_total'] ?? 0, 2, ',', '.')}}</td>
                <td class="border"  style="font-size: x-small;">R$ {{number_format($item['valor_pago_produtor'] ?? 0, 2, ',', '.')}}</td>
                <td class="border"  style="font-size: x-small;">R$ {{number_format($item['valor_subsidio'] ?? 0, 2, ',', '.')}}</td>
                <td class="border"  style="font-size: x-small;">{{number_format($item['percentual_issqn'] ?? 0, 2, ',', '.')}}</td>
                <td class="border"  style="font-size: x-small;">R$ {{number_format($item['valor_issqn'] ?? 0, 2, ',', '.')}}</td>
            </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>