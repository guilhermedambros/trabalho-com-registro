@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.maquina.title_singular') }}
    </div>
    @include('maquinas._form', ['method' => 'POST', 'title' => 'Criar', 'routes' => 'maquinas.store'])
</div>
@endsection