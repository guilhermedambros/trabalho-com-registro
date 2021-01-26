@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.servico.title_singular') }}
    </div>
    @include('servicos._form', ['method' => 'PUT', 'title' => 'Editar', 'routes' => 'servicos.update'])
</div>
@endsection