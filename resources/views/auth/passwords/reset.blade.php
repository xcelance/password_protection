@extends('layouts.app')

@section('content')

    <section class="section-header">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-3"></div>

                <div class="col-sm-6">
                    <h2 class="header-ttl">Reset Password</h2>
                    <p class="header-txt">We will send you an email with your password when we see your request. Please make sure to enter the correct information in the field below.</p>

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <strong>Success! </strong><?php echo session()->get('success') ?>
                        </div>                     
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            <strong>Error! </strong><?php echo session()->get('error') ?>
                        </div>                     
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ url('/generate-password') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-div-top">
                                    <input id="email" type="text" class="inputText" name="email" value="{{ old('email') }}" required autofocus>
                                    <span  class="floating-label">E-mail Address</span>
                                    <div class="err-icon">
                                        @if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-div-top">
                                    <input id="password" type="text" class="inputText" name="password" required>
                                    <span  class="floating-label">Password</span>
                                    <div class="err-pass">
                                        @if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-div-top">
                                    <input id="password_confirmation" type="text" class="inputText" name="password_confirmation" required>
                                    <span  class="floating-label">Confirm Password</span>
                                    <div class="err-cpass">
                                        @if ($errors->has('password_confirmation'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_confirmation') }}"></i>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <button id="newr-pass" type="button" class="btn-login"> Reset Password </button>
                        <button type="submit" disabled="" class="btn-login hide"> Reset Password </button>
                    </form>
                </div>
                
            </div>
            
        </div>
    </section>

@endsection
