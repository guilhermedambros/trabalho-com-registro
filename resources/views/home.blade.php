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
        <div class="bg-gray-200 flex justify-between items-center py-20 px-20">
        <div class="mr-4 text-center">
            <img src="{{ asset('storage/img_avatar.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('pessoas.index') }}" class="img-fluid" role="button" aria-pressed="true">Produtor</a>
        </div>
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/tractor-emoji.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('maquinas.index') }}" class="img-fluid" role="button" aria-pressed="true">Máquinas</a>
        </div>
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/servicos_maquinas.jpg') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('servicos.index') }}" class="img-fluid" role="button" aria-pressed="true">Serviços</a>
        </div>
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/relatorio.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="#" class="img-fluid" role="button" aria-pressed="true"> Gerar Relatório</a>
        </div>
    </div>
       
</div>
@endsection
@section('scripts')
@parent

@endsection