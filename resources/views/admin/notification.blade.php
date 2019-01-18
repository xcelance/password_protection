@extends('layouts.app')

@section('content')

	<div class="container">
		<h2>Forgotten password list.</h2>
		<ul class="list-group">
			@foreach($notifications as $notification)
		  		<li class="list-group-item">
		  			<strong>{{ $notification->email }}</strong> last message to you, we recognize using industry best standards is better and will update the wireframes and user story accordingly.
		  		</li>
		  	@endforeach
		</ul>
	</div>

@endsection