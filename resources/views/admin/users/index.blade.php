@extends('layouts.admin')
@section('styles')
<!-- Datatable -->
<link rel="stylesheet" href="{{asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">{{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}</h1>
  <!-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
    <li class="breadcrumb-item active">DataTables</li>
  </ol> -->
  <div class="page-header-actions">
    @can('user_create')
        <a class="btn btn-sm btn-primary btn-round" href="{{ route("admin.users.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }} <i class="icon md-plus" aria-hidden="true"></i> 
        </a>
    @endcan
  </div>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <table class="table table-bordered table-hover dataTable w-full" id="datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                         <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>{{ trans('cruds.user.fields.mobile_no') }}</th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>{{ trans('cruds.user.fields.status') }}</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Datatable -->
<script src="{{asset('global/vendor/datatables.net-bs4/dataTables.config.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowGroup.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.html5.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.flash.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.print.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.colVis.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/pdfmake.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/vfs_fonts.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/jszip.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-select-bs4/dataTables.select.min.js')}}"></script>
<!-- Bootbox -->
<script src="{{asset('global/vendor/bootbox/bootbox.min.js')}}"></script>
<script>
$(function(){
   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    
    @can('user_delete')
      let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
      let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.users.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
          var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
              return $(entry).data('entry-id')
          });
      
          if(ids.length===0){
            alert('{{ trans('global.datatables.zero_selected') }}')
            return
          }

          if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
              headers: {'x-csrf-token': "{{ csrf_token() }}"},
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

    var table = $('#datatable-User').DataTable({ 
      buttons: dtButtons,
      responsive:true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.users.index') }}",
      columns: [
          {data:'select_row', name:'select_row'},
          {data:'name', name:'name'},
          {data:'email', name:'email'},
          {data:'mobile_no', name:'mobile_no'},
          {data: 'roles', name: 'roles'},
          {data:'status', name:'status'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-entry-id',data.id);
      },
    }).on('click', '.delete_row', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        bootbox.dialog({
          message: "Are you sure you want to delete this?",
          title: "ARE YOU SURE?",
          buttons: {
            danger: {
              label: "Confirm",
              className: "btn-danger",
              callback: function callback() {
                $.ajax({
                    url:url ,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', "_token": "{{ csrf_token() }}"}
                }).always(function (data) {
                    table.draw();
                    toastrSuccess('',data.message);
                });
              }
            },
            main: {
              label: "Cancel",
              className: "btn-primary"
            }
          }
        });
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endsection