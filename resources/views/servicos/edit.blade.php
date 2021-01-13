@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.servico.title_singular') }}
    </div>
    @include('servicos._form', ['method' => 'PUT', 'routes' => 'servicos.update'])
</div>
@endsection