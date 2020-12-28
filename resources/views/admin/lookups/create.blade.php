@extends('layouts.admin')
@section('styles')
<!-- Datatable -->
<link rel="stylesheet" href="{{asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.css') }}">
@endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">Add Lookup</h1>
  <div class="page-header-actions">
    <a class="btn btn-sm btn-primary btn-round" href="{{ route("admin.lookups.index") }}">
      <i class="icon md-format-list-bulleted" aria-hidden="true"></i>  View All Lookups
  </a>
  </div>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
          <div class="form-inline">
            <div class="form-group">
              <select class="form-control select2" name="lookup_key_name" id="lookup_key_name"  data-plugin="select2" style="width:150px">
                  <option value="">Select Key Name</option>
                  @foreach(config('config.lookup_list') as $key=>$lookup)
                    <option value="{{$key}}">{{$lookup}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <button id="addToTable" class="btn btn-primary" type="button">
                <i class="icon md-plus" aria-hidden="true"></i> Add Lookup
              </button>
            </div>
          </div>
            <table class="table table-bordered table-hover table-striped" cellspacing="0" id="datatableHMS">
              <thead>
                <tr>
                  <th>Value</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <br><br>
            <div class="clearfix"></div>
            <div class="text-right">
                <div class="form-group">
                    <button class="btn btn-primary waves-effect waves-classic waves-effect waves-classic" type="button" id="save_btn">
                        Save
                    </button>
                    <a href="{{ route("admin.lookups.index") }}" class="btn btn-secondary waves-effect waves-classic waves-effect waves-classic" type="button" id="cancel_btn">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Datatable -->

<script src="{{asset('global/vendor/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowGroup.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.min.js')}}"></script>
<!-- Bootbox -->
<script src="{{asset('global/vendor/bootbox/bootbox.min.js')}}"></script>
<script src="{{ asset('global/vendor/select2/select2.full.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/select2.js')}}"></script>
<script type="text/javascript">
var rowAddColumns='';
var editable_config_opt = {
  aoColumns:[null, {
    "bSortable": false
  }],
  "bPaginate": false,
  language: {
    "sSearchPlaceholder": "Search..",
    "lengthMenu": "_MENU_",
    "search": "_INPUT_"
  }
};
</script>
<script src="{{asset('assets/js/other/editable_table.js')}}"></script>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function callSaveRecords(tbl_data){
  var lookup=$('#lookup_key_name').val();
  
  if(lookup==''){
    return checkFormValidations();
  }else if(tbl_data.length<=0){
    toastrError('','Please add lookup value!.');
    return false;
  }else{
    $.ajax({
       type:'POST',
       url:"{{ route('admin.lookups.store') }}",
       data:{lookup_key_name:lookup,tbl_data:tbl_data},
       beforeSend: function () { $('#hms_loader').show(); },
       success:function(data){
          if(data.success==true){
            toastrSuccess('',data.message);
            setTimeout(function(){ 
              window.location.href="{{ route("admin.lookups.index") }}";
            },2000);
          }else{
            $('#hms_loader').hide();
            toastrError('',data.message); 
          }
       }
  });
  }
}
function checkFormValidations(){
  if($('#lookup_key_name').val()==''){
    toastrError('','Please select lookup key!.');
    return false;
  }else{
    return true;
  }
}
</script>
@endsection