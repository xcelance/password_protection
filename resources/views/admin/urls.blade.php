@extends('layouts.app')

@section('content')

	@if (session()->has('error1'))
        <section class="error-msg-sec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p><i class="fas fa-exclamation-triangle"></i> <?php echo session()->get('error1') ?>.</p>
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
	            	<h2 class="header-ttl">Add Url</h2>

                    <form class="form-horizontal" action="{{ url('/add-url') }}" method="post">
	                	{{ csrf_field() }}

		                <div class="row">
		                    <div class="col-sm-12">

		                        <div class="input-div-top">
								  	<input id="add-url" type="text" class="inputText" name="url" required/>
								  	<span class="floating-label">URL</span>
								  	<div class="err-url"></div>
								</div>
							</div>
						</div>

						<button id="add-urlBtn" class="btn-login" type="button">Add</button>
						<button id="submit-url" disabled="" type="submit" class="btn-login hide">Add</button>
					</form>
	            </div>
	        </div>
	    </div>
	</section>




	<div class="container">
		<div class="users-table">
			<h2 class="users-heading">Urls</h2>

			@if (session()->has('success'))
                <div class="alert alert-success">
                  	<strong>Success!</strong> <?php echo session()->get('success') ?>
                </div>                     
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                  	<strong>Error!</strong> <?php echo session()->get('error') ?>
                </div>                     
            @endif

			<div class="table-body">
				<table class="table">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Url</th>
					      	<th scope="col">Action</th>
					    </tr>
				  	</thead>

				  	<tbody>
				  		<?php $i = 1;?>
				  		@foreach($urls as $url)

						    <tr>
						      	<th scope="row">{{ $i }}</th>
						      	<td>{{ $url->url }}</td>
						      	<td>
						      		<a class="btn btn-danger" href="{{ url('/delete-url').'/'.base64_encode($url->id) }}"><i class="far fa-trash-alt"></i></a>
						      	</td>
						    </tr>

					    	<?php $i++;?>
					    @endforeach


				  	</tbody>
				</table>
				<div class="pagination-custom">
					<?php echo $urls->links(); ?>
				</div>
	            @if(sizeof($urls) == 0) 
	                <div class="no-data"><strong>Currently no urls are there.</strong></div>
	            @endif
			</div>
		</div>
	</div>

@endsection