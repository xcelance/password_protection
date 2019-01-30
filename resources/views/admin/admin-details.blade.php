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
	            <div class="col-sm-6">
	            	<h2 class="header-ttl">Admin</h2>
	                
	                <form class="form-horizontal" action="{{ url('/edit-admin').'/'.base64_encode($admin->id) }}" method="post">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="admin-name" type="text" class="inputText" value="{{ $admin->name }}" name="name" required/>
								  	<span class="floating-label">Name</span>
								  	<div class="err-name hide">
								  		@if ($errors->has('name'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('name') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-email" type="text" class="inputText" value="{{ $admin->email }}" name="mail" required/>
								  	<span class="floating-label">E-mail Address</span>
								  	<div class="err-icon hide">
								  		@if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-pass" type="text" class="inputText" name="passwrd" value="{{ base64_decode($admin->password_show) }}" />
								  	<span class="floating-label">Password</span>
								  	<div class="err-pass hide">
								  		@if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-confirm" type="text" class="inputText" name="password_confirmation"/>
								  	<span class="floating-label">Confirm Password</span>
								  	<div class="err-cpass hide">
								  		@if ($errors->has('password_confirmation'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_confirmation') }}"></i>
                                        @endif
								  	</div>
								</div>
		                        		                        
		                    </div>
		                </div>
		               	
		            	<button id="edit-admin" type="button" class="btn-login">Update</button>
		            	<button type="submit" disabled="" class="btn-login hide">Update</button>
		            </form>
	            </div>
	            
	        </div>
	        
	    </div>
	</section>

@endsection