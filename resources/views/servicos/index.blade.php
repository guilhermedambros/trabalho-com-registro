@extends('layouts.admin')
@section('content')
@can('pessoa_criar')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('servicos.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.servico.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">

    @if (session()->has('message'))
    <div class="alert alert-success">
        <strong>{{ session('message') }}</strong>
    </div>
    @endif
    
    @error('message')
    <div class="alert alert-danger">
        <strong>{{ session('errors')->first('message') }}</strong>
    </div>
    @enderror

    <div class="header">
        {{ trans('cruds.servico.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-servico">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.servico.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.servico.fields.descricao') }}
                        </th>
                        <th>
                            {{ trans('cruds.servico.fields.data_realizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.servico.fields.beneficiario_pessoa_id') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicos as $key => $servico)
                        <tr data-entry-id="{{ $servico->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $servico->id ?? '' }}
                            </td>
                            <td>
                                {{ $servico->descricao ?? '' }}
                            </td>
                            <td>
                                {{ $servico->data_realizacao ?? '' }}
                            </td>
                            <td>
                                {{ $servico->beneficiario->nome ?? '' }}
                            </td>
                            
                            <td>
                                @can('servico_ver')
                                    <a class="btn-sm btn-indigo" href="{{ route('servicos.show', $servico->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('servico_editar')
                                    <a class="btn-sm btn-blue" href="{{ route('servicos.edit', $servico->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('servico_excluir')
                                    <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('servicos.massDestroy') }}",
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
  let table = $('.datatable-servico:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection