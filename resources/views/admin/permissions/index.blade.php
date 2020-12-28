@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ trans('cruds.permission.title_singular') }} {{ trans('global.list') }}</h1>
    <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
      <li class="breadcrumb-item active">DataTables</li>
    </ol> -->
    <div class="page-header-actions">
        @can('permission_create')
            <a class="btn btn-sm btn-primary btn-round" href="{{ route("admin.permissions.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }} <i class="icon md-plus" aria-hidden="true"></i>
            </a>
        @endcan
    </div>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <table class="table table-bordered table-hover dataTable w-full datatable-Permission">
              <thead>
                  <tr>
                      <th width="10">

                      </th>
                      <th>
                          {{ trans('cruds.permission.fields.id') }}
                      </th>
                      <th>
                          {{ trans('cruds.permission.fields.title') }}
                      </th>
                      <th>
                          &nbsp;
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($permissions as $key => $permission)
                      <tr data-entry-id="{{ $permission->id }}">
                          <td>

                          </td>
                          <td>
                              {{ $permission->id ?? '' }}
                          </td>
                          <td>
                              {{ $permission->title ?? '' }}
                          </td>
                          <td>
                              @can('permission_show')
                                  <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                      {{ trans('global.view') }}
                                  </a>
                              @endcan

                              @can('permission_edit')
                                  <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                      {{ trans('global.edit') }}
                                  </a>
                              @endcan

                              @can('permission_delete')
                                  <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">{{ trans('global.delete') }}</button>
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
$(function(){
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    
    @can('permission_delete')
      let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
      let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.permissions.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
          console.log(dt);
          var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
              return $(entry).data('entry-id')
          });
          console.log(ids);
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
      order: [[ 1, 'desc' ]]
    });

    $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endsection