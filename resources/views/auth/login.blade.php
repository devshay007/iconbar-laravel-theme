@extends('layouts.auth')
@section('content')
<div class="panel">
  <div class="panel-body">
    <div class="brand hms_brand">
      <img class="brand-img" src="{{asset('assets/images/icon-2.png')}}" alt="...">
      <span>OCHS</span>
      <h2 class="brand-text font-size-18">
          {{ trans('panel.site_tag') }}
      </h2>
    </div>
    <form method="post" action="{{ route('login') }}" autocomplete="off" id="hms_form">
      @csrf
      <div class="form-group form-material floating {{ $errors->has('email') ? 'has-danger' : '' }}" data-plugin="formMaterial">
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', null) }}" required/>
        <label class="floating-label form-control-label">{{ trans('global.login_email') }}<span class="required">*</span></label>
        <div class="invalid-feedback">
        @if($errors->has('email'))
          {{ $errors->first('email') }}
        @endif
        </div>
      </div>
      <div class="form-group form-material floating {{ $errors->has('password') ? 'has-danger' : '' }}" data-plugin="formMaterial">
        <input id="password" name="password" type="password"  class="form-control" required/>
        <label class="floating-label form-control-label">Password<span class="required">*</span></label>
        <div class="invalid-feedback">
        @if($errors->has('password'))
          {{ $errors->first('password') }}
        @endif
        </div>
      </div>
      <div class="form-group clearfix">
        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
          <input name="remember" type="checkbox" id="remember">
          <label for="remember">{{ trans('global.remember_me') }}</label>
        </div>
        @if(Route::has('password.request'))
            <a class="float-right" href="{{ route('password.request') }}">{{ trans('global.forgot_password') }}</a>
        @endif
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">{{ trans('global.login') }}</button>
    </form>
    <!-- <p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p> -->
  </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('global/vendor/jquery-validate/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
$("#hms_form").validate({
  rules: {
      email: {
        email:true,
        required: true,
        minlength:3
      },
      password: {
        required: true,
        minlength:6
      },
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