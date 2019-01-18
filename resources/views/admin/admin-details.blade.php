@extends('layouts.app')

@section('content')

	<section class="section-header">
		<div class="container">
	    	<div class="row">
	        	<div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<h2 class="header-ttl">Admin</h2>


                    @if (session()->has('success'))
                        <div class="alert alert-success">
                          	<?php echo session()->get('success') ?>
                        </div>                     
                    @endif
                    @if (session()->has('warning'))
                        <div class="alert alert-warning">
                          	<?php echo session()->get('warning') ?>
                        </div>                     
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                          	<?php echo session()->get('error') ?>
                        </div>                     
                    @endif
	                
	                <form class="form-horizontal" action="{{ url('/edit-admin').'/'.base64_encode($admin->id) }}" method="post">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="admin-name" type="text" class="inputText" value="{{ $admin->name }}" name="name" required/>
								  	<span class="floating-label">Name</span>
								  	<div class="err-name">
								  		@if ($errors->has('name'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('name') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-email" type="email" class="inputText" value="{{ $admin->email }}" name="email" required/>
								  	<span class="floating-label">E-mail Address</span>
								  	<div class="err-icon">
								  		@if ($errors->has('email'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('email') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-pass" type="password" class="inputText" name="password"/>
								  	<span class="floating-label">Password</span>
								  	<div class="err-pass">
								  		@if ($errors->has('password'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="admin-confirm" type="password" class="inputText" name="password_confirmation"/>
								  	<span class="floating-label">Confirm Password</span>
								  	<div class="err-cpass">
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