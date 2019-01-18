@extends('layouts.app')

@section('content')


	<section class="section-header">
		<div class="container">
	    	<div class="row">

	        	<div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<h2 class="header-ttl">ShareThisRide</h2>
	                <p class="header-txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

	                @if (session()->has('error'))
		                <div class="alert alert-danger">
		                  	<strong>Error! </strong><?php echo session()->get('error') ?>
		                </div>                     
		            @endif

	                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

	                    <div class="row">
	                        <div class="col-sm-12">
	                        	<div class="input-div-top">
	                            	<input id="login-email" type="text" class="inputText" name="email" placeholder="" value="{{ old('email') }}" required autofocus>
	                                <span  class="floating-label">E-mail Address</span>
	                                <div class="err-icon">
	                                	@if ($errors->has('email'))
	                                		<i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
	                                	@endif
	                                </div>
	                            </div>

	                            <div class="input-div-top">
	                            	<input id="login-password" type="password" class="inputText" placeholder="" name="password" required>
	                                <span class="floating-label">Password</span>
	                                <div class="err-pass">
	                                	@if ($errors->has('password'))
	                                		<i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
	                                	@endif
	                                </div>
	                            </div>
	                            
	                        </div>
	                    </div>
	                

	                    <p class="header-txt-2">Nullam non congue odio, eget condimentum purus. Phasellus lorem lectus, lacinia eu quam non, dignissim euismod leo. Donec venenatis ornare neque, vel sodales libero cursus eu. Quisque egestas mauris sed ex semper lacinia. Morbi tristique ac libero nec volutpat.</p>

	                    <button type="submit" disabled="" class="btn-login">Log In</button>

	                    <p class="forgot-txt"><a href="{{ url('/reset-password') }}">Forgot Password</a></p>

	                </form>
	            </div>
	            
	        </div>	  
	    </div>
	</section>


@endsection