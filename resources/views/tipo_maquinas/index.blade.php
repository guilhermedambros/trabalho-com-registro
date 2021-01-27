@extends('layouts.admin')
@section('content')
@can('tipo_maquina_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('tipo_maquinas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.tipo_maquina.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.tipo_maquina.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-TipoMaquina">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tipo_maquina.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tipo_maquina.fields.descricao') }}
                        </th>
                        <th>
                            {{ trans('cruds.tipo_maquina.fields.valor_hora_subsidiado') }}
                        </th>
                        <th>
                            {{ trans('cruds.tipo_maquina.fields.tipo_bonificacao') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipo_maquinas as $key => $tipo_maquina)
                        <tr data-entry-id="{{ $tipo_maquina->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tipo_maquina->id ?? '' }}
                            </td>
                            <td>
                                {{ $tipo_maquina->descricao ?? '' }}
                            </td>
                            <td>
                                {{ $tipo_maquina->valor_hora_subsidiado ?? '' }}
                            </td>
                            <td>
                                {{ $tipo_maquina->tipo_bonificacao ?? '' }}
                            </td>
                            
                            <td>
                                @can('tipo_maquina_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('tipo_maquinas.show', $tipo_maquina->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tipo_maquina_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('tipo_maquinas.edit', $tipo_maquina->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tipo_maquina_excluir')
                                    <form action="{{ route('tipo_maquinas.destroy', $tipo_maquina->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tipo_maquina_excluir')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tipo_maquinas.massDestroy') }}",
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
  let table = $('.datatable-TipoMaquina:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection