@extends('layouts.admin')
@section('content')
@can('demanda_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('demandas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.demanda.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.demanda.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-Demanda">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.demanda.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.demanda.fields.descricao') }}
                        </th>
                        <th>
                            {{ trans('cruds.demanda.fields.pessoa_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.demanda.fields.data_prazo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandas as $key => $demanda)
                        <tr data-entry-id="{{ $demanda->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $demanda->id ?? '' }}
                            </td>
                            <td>
                                {{ $demanda->descricao ?? '' }}
                            </td>
                            <td>
                                {{ $demanda->pessoa->nome ?? '' }}
                            </td>
                            <td>
                                {{ $demanda->data_prazo ?? '' }}
                            </td>
                            <td>
                                @can('demanda_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('demandas.show', $demanda->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('demanda_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('demandas.edit', $demanda->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('demanda_excluir')
                                    <form action="{{ route('demandas.destroy', $demanda->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('demanda_excluir')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('demandas.massDestroy') }}",
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
  let table = $('.datatable-Demanda:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection