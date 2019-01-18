@extends('layouts.app')

@section('content')

    <section class="section-header">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-3"></div>

                @if (session()->has('success'))
                    <div class="col-sm-6">
                        <h2 class="header-ttl">Your request has been sent.</h2>
                        <p class="header-txt">We will send you an email with your password when we see your request.</p>
                    </div>
                @endif

                <div class="col-sm-6 @if (session()->has('success')) hide @endif">
                    <div class="arrow-div"><a class="back-arrow @if (session('status')) hide @endif" href="{{ url('/login') }}">❮</a></div>
                    <h2 class="header-ttl">Forgot your password?</h2>
                    <p class="header-txt">We will send you an email with your password when we see your request. Please make sure to enter the correct information in the field below.</p>

                    <form class="form-horizontal" method="POST" action="{{ url('/new-password') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-div-top">
                                    <input id="email" type="text" class="inputText" name="email" value="{{ old('email') }}" required>
                                    <span  class="floating-label">E-mail Address</span>
                                    <div class="err-icon">
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

                        <button id="reset-pass" type="button" class="btn-login"> Send Password Reset Link </button>
                        <button type="submit" class="btn-login hide"> Send Password Reset Link </button>
                    </form>
                </div>
                
            </div>
            
        </div>
    </section>

@endsection
