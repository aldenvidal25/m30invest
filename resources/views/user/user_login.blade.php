<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | User </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="M30 Multipurpose Dashboard System" name="description" />
        <meta content="M30 Designs" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.png') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>

    <body class="auth-body-bgg bg-">
        <div class="bg-overla"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="{{ asset('frontend/assets/img/logo/m30.png') }}" height="70" class="logo-dark mx-auto" alt="">
                                    {{-- <img src="{{asset('backend/assets/images/logo-light.png')}}" height="30" class="logo-light mx-auto" alt=""> --}}
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>User Sign In</b></h4>
    
                        <div class="p-3">
<form class="form-horizontal mt-3" method="POST" action="{{ route('login') }}">
@csrf
 <!-- username -->
<div class="form-group mb-3 row">
<div class="col-12">
<input class="form-control" type="text" required="username" id="username" name="username" placeholder="Username">
</div>
</div>
    <!-- Password -->
<div class="form-group mb-3 row">
<div class="col-12">
<input class="form-control" type="password" required="password"id="password" name="password" placeholder="Password">
</div>
</div>
<!-- Remember Me -->
<div class="form-group mb-3 row">
<div class="col-12">
<div class="custom-control custom-checkbox">

</div>
</div>
</div>

<div class="form-group mb-3 text-center row mt-3 pt-1">
<div class="col-12">
<button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
</div>
</div>

<div class="form-group mb-0 row mt-2">
<div class="col-sm-7 mt-3">
<a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
</div>
<div class="col-sm-5 mt-3">
<a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
</div>
</div>
</form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('backend/assets/js/app.js')}}"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

    </body>
</html>
