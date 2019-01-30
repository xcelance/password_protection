@extends('layouts.app')

@section('content')

@if(Auth::check() && Auth::user())
<?php       
             if(isset($_GET['request_uri_path'])){                
                 echo  '<script> window.location.href = "'.$_GET['request_uri_path'].'"; </script>';
               }
?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Main Page</div>

                    <div class="panel-body">

                        Main Page
                    </div>
                </div>
            </div>
        </div>
    </div>

@else 

    @if(session()->has('error'))
        <section class="error-msg-sec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p><i class="fas fa-exclamation-triangle"></i> <?php echo session()->get('error') ?>.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section-header">
        <div class="container">
            <div class="row">

                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                
                    <h2 class="header-ttl">ShareThisRide</h2>
                    <p class="header-txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                    <form class="form-horizontal" method="POST" action="{{ url('/mylogin') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-div-top ">
                                    <input id="login-email" type="text" class="inputText @if($errors->first('email')) has-error @endif" name="email" placeholder="" value="{{ old('email') }}" required autofocus>
                                    <span  class="floating-label">E-mail Address</span>
                                    <div class="err-icon hide">
                                        @if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-div-top">
                                    <input id="login-password" type="password" class="inputText @if($errors->first('password')) has-error @endif" placeholder="" name="password" required>
                                    <span class="floating-label">Password</span>
                                    <div class="err-pass hide">
                                        @if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    

                        <p class="header-txt-2">Nullam non congue odio, eget condimentum purus. Phasellus lorem lectus, lacinia eu quam non, dignissim euismod leo. Donec venenatis ornare neque, vel sodales libero cursus eu. Quisque egestas mauris sed ex semper lacinia. Morbi tristique ac libero nec volutpat.</p>

                        <button type="submit" disabled="" class="btn-login disabled">Log In</button>

                        <p class="forgot-txt"><a href="{{ url('/password/reset') }}">Forgot Password</a></p>

                    </form>
                </div>
                
            </div>    
        </div>
    </section>

@endif

@endsection