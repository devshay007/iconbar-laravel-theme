@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.css') }}">
@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">Create Hospital</h1>
</div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <form method="POST" action="{{ route("admin.hospitals.store") }}" enctype="multipart/form-data" id="hms_form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospcode') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="name">Hospital Code<span class="required">*</span></label>
                            <input class="form-control" type="text" name="hospcode" id="hospcode" maxlength="5" value="{{ old('hospcode','') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('hospcode'))
                                {{ $errors->first('hospcode') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospname') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospname">Hospital name<span class="required">*</span></label>
                            <input class="form-control" type="text" name="hospname" id="hospname" maxlength="100" value="{{ old('hospname','') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospname'))
                                {{ $errors->first('hospname') }}
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group form-material {{ $errors->has('hospaddr1') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospaddr1">Address 1</label><span class="required">*</span></label>
                            <textarea class="form-control" id="hospaddr1" name="hospaddr1" rows="3" maxlength="100">{{ old('hospaddr1','') }}</textarea>
                            <div class="invalid-feedback">
                                @if($errors->has('hospaddr1'))
                                {{ $errors->first('hospaddr1') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospaddr2') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospaddr2">Address 2</label></label>
                            <textarea class="form-control" id="hospaddr2" name="hospaddr2" rows="3" maxlength="100">{{ old('hospaddr2','') }}</textarea>
                            <div class="invalid-feedback">
                                @if($errors->has('hospaddr2'))
                                {{ $errors->first('hospaddr2') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospaddr3') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospaddr3">Address 3</label></label>
                            <textarea class="form-control" id="hospaddr3" name="hospaddr3" rows="3" maxlength="100">{{ old('hospaddr3','') }}</textarea>
                            <div class="invalid-feedback">
                                @if($errors->has('hospaddr3'))
                                {{ $errors->first('hospaddr3') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospzip') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospzip">Pincode</label>
                            <input class="form-control" type="number" name="hospzip" id="hospzip" value="{{ old('hospzip','') }}" maxlength="8" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospzip'))
                                {{ $errors->first('hospzip') }}
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospcity') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospcity">City<span class="required">*</span></label>
                            <input class="form-control" type="text" name="hospcity" id="hospcity" maxlength="50" value="{{ old('hospcity','') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospcity'))
                                {{ $errors->first('hospcity') }}
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospstate') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospstate">State<span class="required">*</span></label>
                            <input class="form-control" type="text" name="hospstate" id="hospstate" maxlength="50" value="{{ old('hospstate','') }}" maxlength="50">
                            <div class="invalid-feedback">
                                @if($errors->has('hospstate'))
                                {{ $errors->first('hospstate') }}
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospcontry') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospcontry">Country<span class="required">*</span></label>
                            <input class="form-control" type="text" name="hospcontry" id="hospcontry" maxlength="50" value="{{ old('hospcontry','') }}" maxlength="50" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospcontry'))
                                {{ $errors->first('hospcontry') }}
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospemail') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospemail">Email Address<span class="required">*</span></label>
                            <input class="form-control" type="email" name="hospemail" id="hospemail" maxlength="100" value="{{ old('hospemail','') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospemail'))
                                {{ $errors->first('hospemail') }}
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospweb') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospweb">Web Address<span class="required">*</span></label>
                            <input class="form-control" type="url" name="hospweb" id="hospweb" maxlength="100" value="{{ old('hospweb','') }}" >
                            <div class="invalid-feedback">
                                @if($errors->has('hospweb'))
                                {{ $errors->first('hospweb') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospphone') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospphone">Contact No<span class="required">*</span></label>
                            <input class="form-control" type="number" name="hospphone" id="hospphone" minlength="10" value="{{ old('hospphone','') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('hospphone'))
                                {{ $errors->first('hospphone') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospmobile1') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospmobile1">Mobile No 1<span class="required">*</span></label>
                            <input class="form-control" type="number" name="hospmobile1" id="hospmobile1" minlength="10" value="{{ old('hospmobile1','') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('hospmobile1'))
                                {{ $errors->first('hospmobile1') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-material {{ $errors->has('hospmobile2') ? 'has-danger' : '' }}">
                            <label class="form-control-label" for="hospmobile2">Mobile No 2</label>
                            <input class="form-control" type="number" name="hospmobile2" id="hospmobile2" minlength="10" value="{{ old('hospmobile2','') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('hospmobile2'))
                                {{ $errors->first('hospmobile2') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary waves-effect waves-classic" type="submit">
                                Save
                            </button>
                            <button class="btn btn-secondary waves-effect waves-classic" type="button">
                                Cancel
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
<script src="{{asset('global/vendor/select2/select2.full.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/select2.js')}}"></script>
<script src="{{asset('global/vendor/jquery-validate/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
   $("#hms_form").validate({
        rules: {
            hospcode: {
               required: true,
               maxlength:5
            },
            hospname: {
               required: true,
               maxlength:100
            },
            hospaddr1: {
               required: true,
               maxlength:100
            },
            hospaddr2: {
               maxlength:100
            },hospaddr3: {
               maxlength:100
            },
            hospzip: {
               maxlength:8,
               minlength:5,
               number:true,
            },hospcity: {
                required: true,
                maxlength:50,
            },hospstate: {
                required: true,
                maxlength:50,
            },hospcontry: {
                required: true,
                maxlength:50,
            },hospemail: {
               email:true,
               required: true,
               maxlength:100
            },hospweb: {
                required: true,
                maxlength:100,
            },hospphone: {
               required: true,
               number:true,
               minlength:10
            },hospmobile1: {
                required: true,
                number:true,
                minlength:10
            },hospmobile2: {
                number:true,
                minlength:10
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
