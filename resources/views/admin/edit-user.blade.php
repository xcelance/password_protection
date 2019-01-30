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
	            	<h2 class="header-ttl">Edit {{ ucwords($user->name) }}</h2>            
	                
	                <form class="form-horizontal" action="{{ url('/edit-user').'/'.base64_encode($user->id) }}" method="post" autocomplete="false">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="edit-name" type="text" class="inputText" value="{{ $user->name }}" name="name" required/>
								  	<span class="floating-label">Name</span>
								  	<div class="err-name">
								  		@if ($errors->has('name'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('name') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="edit-email" autocomplete="false" type="text" class="inputText" value="{{ $user->email }}" name="mail" required/>
								  	<span class="floating-label">E-mail Address</span>
								  	<div class="err-icon">
								  		@if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="edit-pass" type="text" class="inputText" value="{{ base64_decode($user->password_show) }}" name="passwrd"/>
								  	<span class="floating-label">Password</span>
								  	<div class="err-pass">
								  		@if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="edit-confirm" type="text" class="inputText" name="password_confirmation"/>
								  	<span class="floating-label">Confirm Password</span>
								  	<div class="err-cpass">
								  		@if ($errors->has('password_confirmation'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_confirmation') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
									<select id="edit-url" class="selectVal" name="url" required>
										<option value="">-- Select Url --</option>
										@foreach($urls as $url)
											<option value="{{ $url->url }}" <?php if($url->url == $user->url) { echo "selected"; } ?>>{{ $url->url }}</option>
										@endforeach
									</select>
									<div class="err-url">
								  		@if ($errors->has('url'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('url') }}"></i>
                                        @endif
								  	</div>
								</div>
		                        		                        
		                    </div>
		                </div>
		               
		            	<button id="edit-user-btn" type="button" class="btn-login">Update</button>
		            	<button id="edit-submit" type="submit" disabled="" class="btn-login hide">Update</button>
		            </form>
	            </div>
	            
	        </div>
	        
	    </div>
	</section>

@endsection