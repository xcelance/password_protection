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

	<div class="container">
		<div class="users-table">
			<div class="row">
				<div class="col-sm-2">
					<h2 class="users-heading">Users</h2>
				</div>
				<div class="col-sm-10">
					<div class="search-field">	
		        		<div class="input-div-top">
						  	<input id="search-user" type="text" class="inputText" name="search"/>
						  	<span class="floating-label">Search</span>
						</div>
		        	</div>

				</div>
			</div>
			
            

			<div class="table-body">
				<table id="users-table" class="table users-table-body">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Name</th>
					      	<th scope="col">E-mail</th>
					      	<th scope="col">Url</th>
					      	<th scope="col">Action</th>
					    </tr>
				  	</thead>

				  	<tbody>
				  		<?php $i = 1;?>
				  		@foreach($users as $user)

						    <tr>
						      	<th scope="row">{{ $i }}</th>
						      	<td>{{ $user->name }}</td>
						      	<td>{{ $user->email }}</td>
						      	<td>{{ $user->url }}</td>
						      	<td>
						      	 	<div style="display: none;">{{ $user->active }}</div>
						      		@if($user->active == '0')
						      			<a class="btn btn-success" title="Active" href="{{ url('/active-user').'/'.base64_encode($user->id) }}"><i class="far fa-user"></i></a>
						      		@else
						      			<a class="btn btn-warning" title="Inactive" href="{{ url('/active-user').'/'.base64_encode($user->id) }}"><i class="far fa-user"></i></a>
						      		@endif
						      		<a class="btn btn-info" title="Edit" href="{{ url('/edit-user').'/'.base64_encode($user->id) }}"><i class="fas fa-pen"></i></a>
						      		<a class="btn btn-danger" title="Delete" href="{{ url('/delete-user').'/'.base64_encode($user->id) }}"><i class="far fa-trash-alt"></i></a>
						      	</td>
						    </tr>

					    	<?php $i++;?>
					    @endforeach

				  	</tbody>
				</table>
				
	            @if(sizeof($users) == 0) 
	                <div class="no-data"><strong>Currently no users are there.</strong></div>
	            @endif
			</div>

		</div>

	</div>

@endsection