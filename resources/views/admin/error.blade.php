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

	<section class="section-header">
		<div class="container">
	    	<div class="row">
	        	<div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<h2 class="header-ttl">Error</h2>
	                
	                <form class="form-horizontal" action="{{ url('/edit-errors') }}" method="post">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="error-text" type="text" class="inputText" name="error" value="{{ $error->text }}" required>
								  	<span class="floating-label">Error Message</span>
								  	<div class="err-name">
								  		@if ($errors->has('error'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('error') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="error-text" type="text" class="inputText" name="password_error" value="{{ $perror->text }}" required>
								  	<span class="floating-label">Password Error</span>
								  	<div class="err-name">
								  		@if ($errors->has('error'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('password_error') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="error-text" type="text" class="inputText" name="login_error" value="{{ $lerror->text }}" required>
								  	<span class="floating-label">Login Error</span>
								  	<div class="err-name">
								  		@if ($errors->has('error'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('login_error') }}"></i>
                                        @endif
								  	</div>
								</div>

								<div class="input-div-top">
								  	<input id="error-text" type="text" class="inputText" name="tokenex_error" value="{{ $teerror->text }}" required>
								  	<span class="floating-label">Expired Token Error</span>
								  	<div class="err-name">
								  		@if ($errors->has('error'))
                                            <i class="fas fa-info-circle" title="{{ $errors->first('tokenex_error') }}"></i>
                                        @endif
								  	</div>
								</div>
		                        		                        
		                    </div>
		                </div>
		               	
		            	
		            	<button type="submit" class="btn-login">Update</button>
		            </form>
	            </div>
	            
	        </div>
	        
	    </div>
	</section>

@endsection