<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>{{ trans('panel.site_full_title') }}</title>
    
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('global/css/bootstrap-extend.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.min.css')}}">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('global/vendor/animsition/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/asscrollable/asScrollable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/switchery/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-v3.min.css')}}">
        
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('global/fonts/material-design/material-design.min.css')}}">
    <link rel="stylesheet" href="{{ asset('global/fonts/brand-icons/brand-icons.min.css')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style type="text/css">
        .hms_brand{
            font-size: 30px;
            font-weight: 600;
            letter-spacing: 4px;
            color: #28ace2;    
        }
        .hms_brand .brand-text{
            margin-top: 15px;
        }
    </style>
    @yield('styles')
    
    <!-- Scripts -->
    <script src="{{ asset('global/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-login-v3 layout-full">
    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle">
        @yield("content")
        <footer class="page-copyright page-copyright-inverse">
          <p>WEBSITE BY Let's Enkindle</p>
          <p>© {{ date('Y') }}. All RIGHT RESERVED.</p>
        </footer>
      </div>
    </div>
    <!-- End Page -->

    <!-- Core  -->
    <script src="{{ asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
    <script src="{{ asset('global/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('global/vendor/popper-js/umd/popper.min.js')}}"></script>
    <script src="{{ asset('global/vendor/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('global/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('global/vendor/mousewheel/jquery.mousewheel.min.js')}}"></script>
    <script src="{{ asset('global/vendor/asscrollbar/jquery-asScrollbar.min.js')}}"></script>
    <script src="{{ asset('global/vendor/asscrollable/jquery-asScrollable.min.js')}}"></script>
    <script src="{{ asset('global/vendor/ashoverscroll/jquery-asHoverScroll.min.js')}}"></script>
    <script src="{{ asset('global/vendor/waves/waves.min.js')}}"></script>
    
    <!-- Plugins -->
    <script src="{{ asset('global/vendor/switchery/switchery.min.js')}}"></script>
    <script src="{{ asset('global/vendor/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('global/vendor/jquery-placeholder/jquery.placeholder.min.js')}}"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('global/js/Component.js')}}"></script>
    <script src="{{ asset('global/js/Plugin.js')}}"></script>
    <script src="{{ asset('global/js/Base.js')}}"></script>
    <script src="{{ asset('global/js/Config.js')}}"></script>
    
    <script src="{{ asset('assets/js/Section/Menubar.js')}}"></script>
    <script src="{{ asset('assets/js/Section/Sidebar.js')}}"></script>
    <script src="{{ asset('assets/js/Section/PageAside.js')}}"></script>
    <script src="{{ asset('assets/js/Plugin/menu.js')}}"></script>
    
    <!-- Config -->
    <script>Config.set('assets', '{{ asset("assets")}}');</script>
    
    <!-- Page -->
    <script src="{{ asset('assets/js/Site.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/asscrollable.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/switchery.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/material.js')}}"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>
    <script>
    $(function(){
      @if(session('message'))
        toastrSuccess('','{{ session('message') }}');
      @endif
      @if($errors->count() > 0)
        var toster_msgs_arr='';
        @foreach($errors->all() as $error)
        toster_msgs_arr+='<li>{{ $error }}</li>';
        @endforeach
        toastrErrors(toster_msgs_arr,'Some fields are incorrect.');
      @endif
    });
    </script>
    @yield('scripts')
  </body>
</html>
