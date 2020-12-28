@extends('layouts.admin')
@section('styles')
<style type="text/css">
	#hms_accordion .panel-title{
		color: #fff !important;
	}
</style>
@endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">Lookup List</h1>
  <div class="page-header-actions">
    <a class="btn btn-sm btn-primary btn-round" href="{{ route("admin.lookups.create") }}">
        Add Lookup <i class="icon md-plus" aria-hidden="true"></i> 
    </a>
  </div>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
           <div class="panel-group" id="hms_accordion">
	        	@foreach(config('config.lookup_list') as $key=>$lookup)
	            <div class="panel panel-primary">
	                <div class="panel-heading" role="tab">
                        <a class="panel-title" data-toggle="collapse" data-parent="#hms_accordion" href="#{{$key}}_tab" aria-controls="collapseTwo">
	                      {{$lookup}}
	                    </a>
                      </div>
	                <div id="{{$key}}_tab" class="panel-collapse collapse">
	                    <div class="panel-body">
	                        <ul class="list-group list-group-dividered list-group-full">
			                    <?php
						          $sub_lookups=App\Models\Lookup::getLookupBykey($key);
						        ?>
						        @foreach($sub_lookups as $sKey=>$s_lookup)
			                    <li class="list-group-item" id="lookup_row_{{$key}}_{{$sKey}}">
			                    	<div class="float-left">
			                    	<i class="icon md-chevron-right" aria-hidden="true"></i> <span class="lookup_val_text">{{$s_lookup->keyvalue}}</span>
			                    	</div>	
			                    	<div class="float-right">
				                    	<button class="btn btn-xs btn-info edit_lookup" data-toggle="tooltip" data-id="{{$s_lookup->lookupid}}" data-lookup="{{$lookup}}" data-lookup-row-id="lookup_row_{{$key}}_{{$sKey}}" data-original-title="Edit">Edit</button>
				                    	<button class="btn btn-xs btn-danger delete_lookup" data-toggle="tooltip" data-id="{{$s_lookup->lookupid}}" data-lookup="{{$lookup}}" data-lookup-row-id="lookup_row_{{$key}}_{{$sKey}}" data-original-title="Delete">Delete</button>
			                    	</div>
			                    </li>
			                    @endforeach
			                </ul>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hms_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="lookup_form" name="lookup_form">
                  <input type="hidden" name="lookup_id" id="lookup_id">
                  <input type="hidden" name="lookup_key" id="lookup_key">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lookup</label>
                    <label class="col-sm-10 col-form-label" id="lookup_text">Value</label>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Value</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="lookup_value" name="lookup_value" placeholder="Enter Value" value="" maxlength="50" required="">
                    </div>
                  </div>

                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="row">
                   <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                   </button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<!-- Bootbox -->
<script src="{{asset('global/vendor/bootbox/bootbox.min.js')}}"></script>
<script>
$(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('body').on('click', '.edit_lookup', function () {
      var lookup_id = $(this).data('id');
      var lookup_name = $(this).data('lookup');
      
      $('#saveBtn').attr('lookup-row-id',$(this).data("lookup-row-id"));

      $.get("{{ route('admin.lookups.index') }}" +'/' + lookup_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Lookup");
          $('#saveBtn').val("edit-user");
          $('#hms_modal').modal('show');
          $('#lookup_text').text(lookup_name);
          $('#lookup_id').val(data.lookupid);
          $('#lookup_key').val(data.keyname);
          $('#lookup_value').val(data.keyvalue);
      });
    });

    $('body').on('click', '.delete_lookup',function(){
      var lookup_id = $(this).data("id");
      var lookup_row_id = $(this).data("lookup-row-id");

      bootbox.dialog({
        message: "Are you sure you want to delete this?",
        title: "ARE YOU SURE?",
        buttons: {
          danger: {
            label: "Confirm",
            className: "btn-danger",
            callback: function callback() {
              $.ajax({
                type: "DELETE",
                url: "{{ route('admin.lookups.store') }}"+'/'+lookup_id,
                success: function(data){
                  if(data.success==true){
                   $('#'+lookup_row_id).remove();
                   toastrSuccess('',data.message);
                  }
                },
                error:function (data){
                    console.log('Error:', data);
                }
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

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        var lookup_row_id = $(this).attr("lookup-row-id");
        var lookup_id=$(this).closest('form').find('#lookup_id').val();
        var lookup_value=$(this).closest('form').find('#lookup_value').val();
        
        $.ajax({
          data: $('#lookup_form').serialize(),
          url: "{{ route('admin.lookups.index') }}"+'/'+lookup_id,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
            $('#lookup_form').trigger("reset");
            $('#hms_modal').modal('hide');
            $('#saveBtn').html('Save Changes');
            $('#'+lookup_row_id+' .lookup_val_text').text(lookup_value);
            toastrSuccess('',data.message);
          },
          error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
          }
      });
    });
});
</script>
@endsection