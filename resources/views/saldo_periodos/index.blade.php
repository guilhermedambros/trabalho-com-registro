@extends('layouts.admin')
@section('content')
@can('saldo_periodo_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('saldo_periodos.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.saldo_periodo.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.saldo_periodo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-SaldoPeriodo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.saldo_periodo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.saldo_periodo.fields.pessoa_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.saldo_periodo.fields.ano_exercicio') }}
                        </th>
                        <th>
                            {{ trans('cruds.saldo_periodo.fields.saldo_pesadas') }}
                        </th>
                        <th>
                            {{ trans('cruds.saldo_periodo.fields.saldo_leves') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saldo_periodos as $saldo_periodo)
                        <tr data-entry-id="{{ $saldo_periodo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $saldo_periodo->id ?? '' }}
                            </td>
                            <td>
                                {{ $saldo_periodo->pessoa->nome ?? '' }}
                            </td>
                            <td>
                                {{ $saldo_periodo->ano_exercicio ?? '' }}
                            </td>
                            <td>
                                {{ $saldo_periodo->saldo_pesadas ?? '' }}
                            </td>
                            <td>
                                {{ $saldo_periodo->saldo_leves ?? '' }}
                            </td>
                    
                            
                            <td>
                                @can('saldo_periodo_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('saldo_periodos.show', $saldo_periodo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('saldo_periodo_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('saldo_periodos.edit', $saldo_periodo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('saldo_periodo_excluir')
                                    <form action="{{ route('saldo_periodos.destroy', $saldo_periodo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('saldo_periodo_excluir')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('saldo_periodos.massDestroy') }}",
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
  let table = $('.datatable-SaldoPeriodo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection