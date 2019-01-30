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
                        <h2 class="header-ttl" onload="redirectUrl()">Your request has been sent.</h2>
                        <p class="header-txt">We will send you an email with your password when we see your request.</p>
                    </div>
                @endif

                <div class="col-sm-6 @if (session()->has('success')) hide @endif">

                    <h2 class="header-ttl">Sorry, the link you clicked on has expired.</h2>
                    <p class="header-txt">Please enter your e-mail address below and we will send you a new link by e-mail.</p>

                    <form class="form-horizontal" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-div-top">
                                    <input id="email" type="text" class="inputText reset-emailfield" name="mail" value="{{ old('email') }}" required>
                                    <span  class="floating-label">E-mail Address</span>
                                    <div class="err-icon hide">
                                        @if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif

                                        @if(session()->has('error'))
                                            <i class="fas fa-info-circle" title="{{ session()->get('error') }}"></i>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <button id="reset-pass" disabled="" type="button" class="btn-login disabled"> Send Password Reset Link </button>
                        <button type="submit" class="btn-login hide"> Send Password Reset Link </button>
                    </form>
                </div>
                
            </div>
            
        </div>
    </section>

@endsection
