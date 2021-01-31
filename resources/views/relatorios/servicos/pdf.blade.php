<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    
    <title>Relatório de serviçoes realizados no período de {{$request->periodo_inicio}} até {{$request->periodo_fim}}</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome do beneficiario</th>
                <th scope="col">Talão</th>
                <th scope="col">Local</th>
                <th scope="col">Nº Contr</th>
                <th scope="col">Prestador</th>
                <th scope="col">Maquina Utilizada</th>
                <th scope="col">Data serviço</th>
                <th scope="col">Valor p/ hora</th>
                <th scope="col">horas</th>
                <th scope="col">Valor total do serviço</th>
                <th scope="col">Valor PG Produtor</th>
                <th scope="col">Valor Subsídio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicos as $servico)
                @if(count($servico->maquinas) > 0)
                    @foreach($servico->maquinas as $maquina)
            <tr>
                <td>{{$servico->beneficiario->nome ?? ''}}</td>
                <td>{{$servico->beneficiario->inscricao ?? ''}}</td>
                <td>{{$servico->endereco ?? ''}}</td>
                <td>{{$servico->numero ?? ''}}</td>
                <td>{{$maquina->proprietario->nome ?? ''}}</td>
                <td>{{$maquina->descricao ?? ''}}</td>
                <td>{{$servico->data_realizacao ?? ''}}</td>
                <td>{{ number_format($maquina->valor_hora, 2, ',', '.') }}</td>
                <td>{{ \App\Helpers\Helpers::convertFloattoHours($maquina->pivot->tempo)}} </td>
                <td>{{ number_format($maquina->pivot->valor_total, 2, ',', '.') }}</td>
                <td>{{ number_format($maquina->pivot->valor_total - $maquina->pivot->valor_subsidiado, 2, ',', '.') }}</td>
                <td>{{ number_format($maquina->pivot->valor_subsidiado, 2, ',', '.') }}</td>
          
            </tr>
                    @endforeach
                @else
            <tr>
                <td>{{$servico->beneficiario->nome ?? ''}}</td>
                <td>{{$servico->beneficiario->inscricao ?? ''}}</td>
                <td>{{$servico->endereco ?? ''}}</td>
                <td>{{$servico->numero ?? ''}}</td>
                <td colspan="8">Nenhuma máquina cadastrada</td>
            </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>