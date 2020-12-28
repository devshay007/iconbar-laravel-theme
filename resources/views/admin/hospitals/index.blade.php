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
  <h1 class="page-title">Hospital List</h1>
  <!-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
    <li class="breadcrumb-item active">DataTables</li>
  </ol> -->
  <div class="page-header-actions">
    @can('user_create')
        <a class="btn btn-sm btn-primary btn-round" href="{{ route("admin.hospitals.create") }}">
           Add Hospital <i class="icon md-plus" aria-hidden="true"></i>
        </a>
    @endcan
  </div>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <table class="table table-bordered table-hover dataTable w-full" id="datatable-Hospital">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                          Hospital Code
                        </th>
                        <th>
                          Hospital Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>Phone</th>
                        <th>
                          City
                        </th>
                        <th>State</th>
                        <th>Country</th>
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

    $.extend(true, $.fn.dataTable.defaults, {
      order: [[ 1, 'desc' ]]
    });

    var table = $('#datatable-Hospital').DataTable({
      buttons: dtButtons,
      responsive:true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.hospitals.index') }}",
      columns: [
          {data:'select_row', name:'select_row'},
          {data:'hospcode', name:'Hospital Code'},
          {data:'hospname', name:'Hospital Name'},
          {data:'hospemail', name:'Email'},
          {data: 'hospphone', name: 'Phone'},
          {data:'hospcity', name:'City'},
          {data: 'hospstate', name: 'State'},
          {data: 'hospcontry', name: 'Country'},
           {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      'createdRow': function( row, data, dataIndex ) {
        $(row).attr('data-entry-id',data.id);
      },
    })

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endsection
