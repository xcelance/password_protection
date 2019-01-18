<!DOCTYPE html>
<html>
	<head>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col s12 m8">
					<div class="card">
						<div class="card-content teal lighten-2">
							<br>
							<span class="card-title center-align">Viviane
							</span>
						</div>

						@if($status == "reset")
							<div class="card-action">
								<h5 style="text-align: left">Password Reset</h5>
								<p>Hello Admin,</p>
								<p style="text-align: justify">Got an reset password request from the user.
								</p>
								<span>
									<p style="text-align: left">Email:</p>
									<h3 style="text-align: left">{{ $email }}</h3>
								</span>
							</div>
						@else 
							<div class="card-action">
								<h5 style="text-align: left">Password Reset</h5>
								<p>Hello {{ $name }},</p>
								<p style="text-align: justify">Here is the password to login into Viviane.
								</p>
								<span>
									<p style="text-align: left">Email:   {{ $email }}</p>
									<p style="text-align: left">Password:   <strong>{{ $password }}</strong></p>
								</span>
							</div>
						@endif
					</div>
					<br>
					<br>
				</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	</body>

</html>
