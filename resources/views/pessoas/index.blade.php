@extends('layouts.admin')
@section('content')
@can('pessoa_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('pessoas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.pessoa.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.pessoa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-Pessoa">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pessoa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pessoa.fields.nome') }}
                        </th>
                        <th>
                            {{ trans('cruds.pessoa.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.pessoa.fields.tipo_pessoa') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pessoas as $key => $pessoa)
                        <tr data-entry-id="{{ $pessoa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pessoa->id ?? '' }}
                            </td>
                            <td>
                                {{ $pessoa->nome ?? '' }}
                            </td>
                            <td>
                                {{ $pessoa->email ?? '' }}
                            </td>
                            <td>
                                {{ $pessoa->tipo_pessoa->descricao ?? '' }}
                            </td>
                            
                            <td>
                                @can('pessoa_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('pessoas.show', $pessoa->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pessoa_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('pessoas.edit', $pessoa->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pessoa_excluir')
                                    <form action="{{ route('pessoas.destroy', $pessoa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('pessoas.massDestroy') }}",
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
  let table = $('.datatable-Pessoa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection