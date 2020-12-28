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
    <br>
    <h3>Forgot Your Password ?</h3>
    <p>Input your registered email to reset your password</p>
    @if(session('status'))
    <div class="alert dark alert-alt alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        {{ session('status') }}
    </div>
    @endif
    <form method="post" action="{{ route('password.email') }}" autocomplete="off">
      @csrf
      <div class="form-group form-material floating" data-plugin="formMaterial">
        <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}"/>
        <label class="floating-label">{{ trans('global.login_email') }}</label>
        @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">{{ trans('global.send_password') }}</button>
    </form>
    <!-- <p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p> -->
  </div>
</div>
@endsection