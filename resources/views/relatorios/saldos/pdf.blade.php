<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    
    <title>Laravel 8 Generate PDF From View</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Ano</th>
                <th scope="col">Produtor</th>
                <th scope="col">Saldo em Pesadas</th>
                <th scope="col">Valor bonificado em pesadas</th>
                <th scope="col">Saldo em leves</th>
                <th scope="col">Valor bonificado em leves</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saldos as $saldo)
            <tr>
                <td>{{$saldo->ano_exercicio ?? ''}}</td>
                <td>{{$saldo->pessoa->nome ?? ''}}</td>
                <td>{{$saldo->saldo_pesadas ?? ''}}</td>
                <td>{{$saldo->ano_exercicio ?? ''}}</td>
                <td>{{$saldo->saldo_leves ?? ''}}</td>
                <td>{{$saldo->ano_exercicio ?? ''}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>