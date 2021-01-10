@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        Painel Principal
    </div>
    
    <div class="body">
        @if(session('status'))
            <div class="alert success">
                {{ session('status') }}
            </div>
        @endif
        <div class="painel">    
            <div class="row">
                <span class="d-block p-2 bg-primary text-white" >
                    <a href="#" class="img-fluid" role="button" aria-pressed="true"><i class="fa fa-plus"></i> Cadastrar Pessoa</a>
                </span> 
                <span class="d-block p-2 bg-primary text-white" >
                    <a href="#" class="img-fluid" role="button" aria-pressed="true"><i class="fa fa-plus"></i> Cadastrar Máquina</a>
                </span> 
            </div>
            <div class="row">
                <span class="d-block p-2 bg-primary text-white" >
                    <a href="#" class="img-fluid" role="button" aria-pressed="true"><i class="fa fa-plus"></i> Cadastrar Serviço</a>
                </span>  
                <span class="d-block p-2 bg-primary text-white" >
                    <a href="#" class="img-fluid" role="button" aria-pressed="true"><i class="fa fa-plus"></i> Gerar Relatório</a>
                </span> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection