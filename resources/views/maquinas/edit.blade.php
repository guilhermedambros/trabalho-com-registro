@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.maquina.title_singular') }}
    </div>
    @include('maquinas._form', ['method' => 'PUT', 'routes' => 'maquinas.update'])
</div>
@endsection