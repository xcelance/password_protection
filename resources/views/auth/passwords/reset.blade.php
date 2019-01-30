@extends('layouts.app')

@section('content')

    @if (session()->has('error'))
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

    <section class="error-msg-sec error-messages hide">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p><i class="fas fa-exclamation-triangle"></i> {{ $error->text }}.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="error-msg-sec passerror-messages hide">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p><i class="fas fa-exclamation-triangle"></i> {{ $perr->text }}.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-header">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-3"></div>

                @if (session()->has('success'))
                    <script type="text/javascript"> 
                        setTimeout( function() {
                            window.location.href = "{{ url('/') }}";
                        }, 5000); 
                    </script>
                    <div class="col-sm-6">
                        <h2 class="header-ttl" onload="redirectUrl()">Your password has been reset.</h2>
                        <p class="header-txt">You can now log in using your new password.</p>
                    </div>
                @endif

                <div class="col-sm-6 @if (session()->has('success')) hide @endif">
                    <h2 class="header-ttl">Reset Password</h2>
                    <p class="header-txt">We will send you an email with your password when we see your request. Please make sure to enter the correct information in the field below.</p>

                    <form class="form-horizontal" method="POST" action="{{ url('/password/update').'/'.$token }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-div-top">
                                    <input id="email" type="text" class="inputText createpass-emailfield" name="mail" value="{{ old('email') }}" required autofocus>
                                    <span  class="floating-label">E-mail Address</span>
                                    <div class="err-icon hide">
                                        @if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-div-top">
                                    <input id="password" type="text" class="inputText createpass-passfield" name="passwrd" required>
                                    <span  class="floating-label">Password</span>
                                    <div class="err-pass hide">
                                        @if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-div-top">
                                    <input id="password_confirmation" type="text" class="inputText createpass-cpassfield" name="password_confirmation" required>
                                    <span  class="floating-label">Confirm Password</span>
                                    <div class="err-cpass hide">
                                        @if ($errors->has('password_confirmation'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_confirmation') }}"></i>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <button id="newr-pass" disabled="" type="button" class="btn-login disabled"> Reset Password </button>
                        <button type="submit" disabled="" class="btn-login hide"> Reset Password </button>
                    </form>
                </div>
                
            </div>
            
        </div>
    </section>

@endsection
