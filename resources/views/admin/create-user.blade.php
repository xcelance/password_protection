@extends('layouts.app')

@section('content')

	<section class="section-header">
		<div class="container">
	    	<div class="row">
	        	<div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<h2 class="header-ttl">Create New User</h2>


                    @if (session()->has('success'))
                        <div class="alert alert-success">
                          	<?php echo session()->get('success') ?>
                        </div>                     
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                          	<?php echo session()->get('error') ?>
                        </div>                     
                    @endif
	                
	                <form class="form-horizontal create-userForm" action="{{ url('/create-user') }}" method="post">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="create-name" type="text" class="inputText" value="{{ old('name') }}" name="name" required/>
								  	<span class="floating-label">Name</span>
								  	<div class="err-name">
								  		@if ($errors->has('name'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('name') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="create-email" type="text" class="inputText" value="{{ old('email') }}" name="email" required/>
								  	<span class="floating-label">E-mail Address</span>
								  	<div class="err-icon">
								  		@if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="create-pass" type="text" class="inputText" name="password" required/>
								  	<span class="floating-label">Password</span>
								  	<div class="err-pass">
								  		@if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="create-confirm" type="text" class="inputText" name="password_confirmation" required/>
								  	<span class="floating-label">Confirm Password</span>
								  	<div class="err-cpass">
								  		@if ($errors->has('password_confirmation'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_confirmation') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
									<select id="create-url" class="selectVal" name="url" required>
										<option value="">-- Select Url --</option>
										@foreach($urls as $url)
											<option value="{{ $url->url }}">{{ $url->url }}</option>
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
		               
		            	<button id="register-btn" type="button" class="btn-login">Create</button>
		            	<button type="submit" disabled="" class="btn-login hide">Create</button>
		            </form>
	            </div>
	            
	        </div>
	        
	    </div>
	</section>

@endsection