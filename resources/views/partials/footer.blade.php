<!-- Scripts -->

<script src="{{ asset('public/js/app.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ url('public/js/custom.js') }}"></script>
@if(Auth::check() && Auth::user()->role == "0")
	<script src="{{ url('public/js/admin-notify.js') }}"></script>
@endif