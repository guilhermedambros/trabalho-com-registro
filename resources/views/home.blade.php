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
        
            Bem vindo ao sistema {{ trans('panel.site_title') }}

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