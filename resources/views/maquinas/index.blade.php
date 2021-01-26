@extends('layouts.admin')
@section('content')
@can('pessoa_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('maquinas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.maquina.title_singular') }}
        </a>
    </div>
@endcan
@if (session()->has('message'))
    <div class="alert alert-success">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
<div class="main-card">
    <div class="header">
        {{ trans('cruds.maquina.title_singular') }} {{ trans('cruds.list.title_singular') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-maquina">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.maquina.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.maquina.fields.descricao') }}
                        </th>
                        <th>
                            {{ trans('cruds.maquina.fields.valor_hora') }}
                        </th>
                        <th>
                            {{ trans('cruds.maquina.fields.tipo_maquina') }}
                        </th>
                        <th>
                            {{ trans('cruds.maquina.fields.proprietario') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maquinas as $key => $maquina)
                        <tr data-entry-id="{{ $maquina->id }}">
                            <td> 

                            </td>
                            <td>
                                {{ $maquina->id ?? '' }}
                            </td>
                            <td>
                                {{ $maquina->descricao ?? '' }}
                            </td>
                            <td>
                                R$ {{ $maquina->valor_hora ?? '' }}
                            </td>
                            <td>
                                {{ $maquina->tipo_maquina->descricao ?? '' }}
                            </td>
                            <td>
                                {{ $maquina->proprietario->nome ?? '' }}
                            </td>
                            <td>
                                @can('maquina_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('maquinas.show', $maquina->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('maquina_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('maquinas.edit', $maquina->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('maquina_excluir')
                                    <form action="{{ route('maquinas.destroy', $maquina->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn-sm btn-red" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pessoa_excluir')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('maquinas.massDestroy') }}",
    className: 'btn-red',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-maquina:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection