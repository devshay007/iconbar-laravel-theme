@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}</h1>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data" id="hms_form">
                @csrf
                <div class="form-group form-material">
                    <label class="form-control-label required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    <div class="invalid-feedback">
                    @if($errors->has('title'))
                        {{ $errors->first('title') }}
                    @endif
                    </div>
                    <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required data-plugin="select2">
                        @foreach($permissions as $id => $permissions)
                            <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permissions }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                    @if($errors->has('permissions'))
                          {{ $errors->first('permissions') }}
                    @endif
                    </div>
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    <div class="error_div"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary waves-effect waves-classic" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $("#hms_form").validate({
            rules: {
               title: {
                   required: true,
                   minlength:3
               },
               "permissions[]": {
                   required: true
               }
            },
            errorPlacement: function (error, element){
                $placement=$(element).parent().find('.invalid-feedback');
                error.appendTo($placement);
                $placement.show();
            },
            highlight: function(element, errorClass, validClass){
                $(element).parent().addClass('has-danger');
                $placement=$(element).parent().find('.invalid-feedback');
                $placement.show();
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).parent().removeClass('has-danger');
                $placement=$(element).parent().find('.invalid-feedback');
                $(element).removeClass('error');
                $placement.hide();
            }
       });
</script>
@endsection