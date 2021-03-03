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
    
    
    <title>Relatório de serviçoes realizados no período de {{$request->mes}}/{{$request->ano}}</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr class="text-center h4">
                <td style="border: 0 !important;">GUILHERME DAMBROS</td>
            </tr>
            <tr class="text-center h5">
                <td style="border: 0 !important;">RELATÓRIO DA PRESTAÇÃO DE SERVIÇOS </td>
            </tr>
            <tr class="text-center h6">
                <td  style="border: 0 !important;">Período: {{$request->mes}}/{{$request->ano}}</td>
            </tr>
        </thead>
    </table>
    @foreach($demandas as $demanda)
    @php
        $tempo = 0;
    @endphp
    <table  class="table table-striped">
        <thead>
        <tr class="text-center h6">
                <td colspan="3"  style="border: 0 !important;">{{$demanda->pessoa->nome}} - {{$demanda->descricao}}</td>
            </tr>
            <tr class="h6 border">
                <th class="border"  style="font-size: x-small;"  scope="col">Data do atendimento</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Descricao</th>
                <th class="border"  style="font-size: x-small;"  scope="col">Tempo</th>
            </tr>
        </thead>
        <tbody>            
        @if(count($demanda->registros_no_periodo($request->mes, $request->ano)) > 0)
            @foreach($demanda->registros_no_periodo($request->mes, $request->ano) as $registro)
            @php
                $tempo += $registro->tempo;
            @endphp
            <tr>
                <td class="border"  style="font-size: x-small;">{{$registro->data_registro ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{$registro->descricao ?? ''}}</td>
                <td class="border"  style="font-size: x-small;">{{App\Helpers\Helpers::convertFloatToHours($registro->tempo)}}</td>
            </tr>
            @endforeach
        @endif
            <tr>
                <th class="border"  style="font-size: x-small;">Valor total</th>
                <th class="border"  style="font-size: x-small;">{{ number_format($tempo * $demanda->valor_hora, 2, ',', '.') }}</th>
                <th class="border"  style="font-size: x-small;">{{ \App\Helpers\Helpers::convertFloattoHours($tempo)}} </th>
            </tr>
        </tbody>
    </table>
    @endforeach
    
</body>
</html>