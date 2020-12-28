@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.css') }}">
@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}</h1>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data" id="hms_form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('name') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="name">{{trans('cruds.user.fields.name')}}<span class="required">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('name'))
                                {{ $errors->first('name') }}
                                @endif
                            </div>
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('email') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="email">{{ trans('cruds.user.fields.email') }}<span class="required">*</span></label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('email'))
                                {{ $errors->first('email') }}
                                @endif
                            </div>
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('mobile_no') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="mobile_no">{{ trans('cruds.user.fields.mobile_no') }}<span class="required">*</span></label>
                            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no','') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('mobile_no'))
                                {{ $errors->first('mobile_no') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="password">{{ trans('cruds.user.fields.password') }}<span class="required">*</span></label>
                            <input class="form-control" type="password" name="password" id="password" >
                            <div class="invalid-feedback">
                                @if($errors->has('password'))
                                {{ $errors->first('password') }}
                                @endif
                            </div>
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="password_confirmation">{{ trans('cruds.user.fields.confirm_password') }}<span class="required">*</span></label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" >
                            <div class="invalid-feedback">
                                @if($errors->has('password_confirmation'))
                                {{ $errors->first('password_confirmation') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('roles') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="roles">{{ trans('cruds.user.fields.roles') }}<span class="required">*</span></label>
                            <select class="form-control select2" name="roles[]" id="roles" multiple data-plugin="select2">
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                @if($errors->has('roles'))
                                {{ $errors->first('roles') }}
                                @endif
                            </div>
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('status') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="roles">{{ trans('cruds.user.fields.status') }}<span class="required">*</span></label>
                            <select class="form-control select2" name="status" id="status"  data-plugin="select2">
                                <option value="0" {{ (old('status')==0) ? 'selected' : '' }}>InActive</option>
                                <option value="1" {{ (old('status')==1) ? 'selected' : '' }}>Active</option>
                            </select>
                            <div class="invalid-feedback">
                                @if($errors->has('status'))
                                {{ $errors->first('status') }}
                                @endif
                            </div>                    
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary waves-effect waves-classic" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('global/vendor/select2/select2.full.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/select2.js')}}"></script>
<script src="{{asset('global/vendor/jquery-validate/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
   $("#hms_form").validate({
        rules: {
            name: {
               required: true,
               minlength:3
            },
            email: {
               email:true,
               required: true,
               minlength:3
            },
            mobile_no: {
               required: true,
               number:true,
               minlength:10
            },
            password:{
               required: true,
               minlength:6
            },
            password_confirmation : {
            	required: true,
                minlength : 6,
                equalTo : "#password"
            },
            "roles[]":{
            	required: true,
            },
            status:{
               required: true
            }
        },
        errorPlacement: function (error, element){
            $placement=$(element).parent().find('.invalid-feedback');
            error.appendTo($placement);
            $placement.show();
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parent().addClass('has-danger').removeClass('has-success');
            $placement=$(element).parent().find('.invalid-feedback');
            $placement.show();
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass('has-danger').addClass('has-success');
            $placement=$(element).parent().find('.invalid-feedback');
            $(element).removeClass('error');
            $placement.hide();
        }
   });
</script>
@endsection