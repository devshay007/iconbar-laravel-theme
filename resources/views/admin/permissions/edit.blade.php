@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}</h1>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
        <form method="POST" id="hms_form" action="{{ route("admin.permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group form-material">
                <label class="form-control-label required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title) }}" required>
                <div class="invalid-feedback">
                @if($errors->has('title'))
                    {{ $errors->first('title') }}
                @endif
                </div>
                <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
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
                   minlength:2
               }
            },
            errorPlacement: function (error, element){
                $placement=$(element).parent().find('.invalid-feedback');
                error.appendTo($placement);
                $placement.show();
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parent().addClass('has-danger');
                $placement=$(element).parent().find('.invalid-feedback');
                $placement.show();
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parent().removeClass('has-danger');
                $placement=$(element).parent().find('.invalid-feedback');
                $(element).removeClass('error');
                $placement.hide();
            }
       });
</script>
@endsection