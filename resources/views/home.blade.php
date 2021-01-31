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
        @if($saldos)
            @if($saldos['status'])
            Bem vindo ao sistema {{ trans('panel.site_title') }}
            <div id="alert_success_saldo" class="relative py-3 pl-4 pr-10 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                <p>{{$saldos['msg']}}.</p>
                <span onClick="alert_dimiss()" class="absolute inset-y-0 right-0 flex items-center mr-4">
                    <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            @else
            <div class="overflow-hidden leading-normal rounded-lg" role="alert">
                <p class="px-4 py-3 font-bold text-red-100 bg-red-800">Atenção!</p>
                <p class="px-4 py-3 text-red-700 bg-red-100 ">
                    {{$saldos['msg']}}. 
                    Para regularizar a situação, 
                    <a href="{{route('saldo_periodos.ajusta_saldos_do_periodo_atual')}}" 
                        class="bg-red-500 rounded-lg font-bold text-white text-center px-4 py-1 transition duration-300 ease-in-out hover:bg-green-600 mr-6">
                        Clique aqui.
                    </a>
                </p>
            </div>

            @endif
        @else
            Bem vindo ao sistema {{ trans('panel.site_title') }}
        @endif
<<<<<<< HEAD
        <div class="bg-gray-200 flex justify-between items-center py-20 px-20">
        @can('maquina_acessar')
        <div class="mr-4 text-center">
            <img src="{{ asset('storage/img_avatar.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('pessoas.index') }}" class="img-fluid" role="button" aria-pressed="true">Produtor</a>
        </div>
        @endcan
        @can('maquina_acessar')
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/tractor-emoji.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('maquinas.index') }}" class="img-fluid" role="button" aria-pressed="true">Máquinas</a>
        </div>
        @endcan
        @can('servico_acessar')
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/servicos_maquinas.jpg') }}" alt="" class="w-full mr-2 rounded">
            <a href="{{ route('servicos.index') }}" class="img-fluid" role="button" aria-pressed="true">Serviços</a>
        </div>
        @endcan
        @can('relatorios_acessar')
        <div class="mr-5 text-center">
            <img src="{{ asset('storage/relatorio.png') }}" alt="" class="w-full mr-2 rounded">
            <a href="#" class="img-fluid" role="button" aria-pressed="true"> Gerar Relatório</a>
=======
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1">
            @can('pessoa_acessar')
            <!-- light mode -->
            <div class="card mx-auto sm:px-6 lg:px-8 m-4">
                <div class="overflow-hidden shadow-md">
                    <!-- card header -->
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
                        Cadastro de pessoas
                    </div>

                    <!-- card body -->
                    <div class="p-6 bg-white border-b border-gray-200">
                        Esse cadastro permite manipular informações referentes a associados, prestadores de serviços e outros.
                    </div>

                    <!-- card footer -->
                    <div class="p-6 bg-white border-gray-200 text-right">
                        <!-- button link -->
                        <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                            href="{{ route('pessoas.index') }}">Acessar</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('maquina_acessar')
            <!-- light mode -->
            <div class="card mx-auto sm:px-6 lg:px-8 m-4">
                <div class="overflow-hidden shadow-md">
                    <!-- card header -->
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
                        Cadastro de máquinas
                    </div>

                    <!-- card body -->
                    <div class="p-6 bg-white border-b border-gray-200">
                        Esse cadastro permite manipular informações referentes ao maquinário utilizado nos serviços, bem como valores.
                    </div>

                    <!-- card footer -->
                    <div class="p-6 bg-white border-gray-200 text-right">
                        <!-- button link -->
                        <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                            href="{{ route('maquinas.index') }}">Acessar</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('servico_acessar')
            <!-- light mode -->
            <div class="card mx-auto sm:px-6 lg:px-8 m-4">
                <div class="overflow-hidden shadow-md">
                    <!-- card header -->
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
                        Cadastro de Serviços
                    </div>

                    <!-- card body -->
                    <div class="p-6 bg-white border-b border-gray-200">
                        Cadastre os serviços realizados, valores, maquinas.
                    </div>

                    <!-- card footer -->
                    <div class="p-6 bg-white border-gray-200 text-right">
                        <!-- button link -->
                        <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                            href="{{ route('servicos.index') }}">Acessar</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('relatorios_acessar')
            <!-- light mode -->
            <div class="card mx-auto sm:px-6 lg:px-8 m-4">
                <div class="overflow-hidden shadow-md">
                    <!-- card header -->
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
                        Relatórios
                    </div>

                    <!-- card body -->
                    <div class="p-6 bg-white border-b border-gray-200">
                        Gerar relatórios de serviços realizados em determinados períodos.
                    </div>

                    <!-- card footer -->
                    <div class="p-6 bg-white border-gray-200 text-right">
                        <!-- button link -->
                        <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                            href="{{ route('relatorios.servicos.index') }}">Acessar</a>
                    </div>
                </div>
            </div>
            @endcan
        
>>>>>>> 44d758828d45bac875772c733f404d246ca2e75c
        </div>
    </div>
       
</div>
@endsection
@section('scripts')
<script>
function alert_dimiss(){
    document.getElementById("alert_success_saldo").style.display = 'none';
}
</script>
@parent

@endsection