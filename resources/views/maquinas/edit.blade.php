@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.maquina.title_singular') }}
    </div>
    @include('maquinas._form', ['method' => 'PUT', 'title' => 'Editar', 'routes' => 'maquinas.update'])
</div>
@endsection