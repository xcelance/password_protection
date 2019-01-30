
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>INDEX</title>
		<link href="{{ url('/').'/public/css/style.css' }}" rel="stylesheet">
	</head>

	<body>

		<a style="text-decoration: none;color: #000000;" href="{{ url('/view-newmail').'/'.base64_encode($id) }}" target="_blank"><p style="float: right;text-decoration: underline;">View this e-mail in your browser</p></a>


		<div style="width: 70%;margin: 0 auto;clear: both;text-align: center;padding: 20px;">
			<a href="{{ url('/') }}" style="text-decoration: none;color: #000000;"><h3 style="font-size: 24px;">ShareThisRide</h3></a>
			<h1 style="font-size: 40px;">Forgot your password?</h1>
			<p style="font-size: 19px;font-weight: 600;">
				It’s ok, it happens to the best of us. Just click <br/> on the link below to reset your password.
			</p>
			<a href="{{ url('/password/reset/').'/'.$token }}" style="text-decoration: none;">
				<button type="button" style="width: 50%;height: 60px;color: #ffff;border: 1px solid #707070;font-size: 18px;background: #C6C6C6;font-weight: 600;margin: 0 auto;clear: both;display: block; cursor: pointer;">
				Reset Password
				</button> 
			</a>
			<p style="font-size: 19px;">
				If you didn’t make this request, delete this e-mail and your<br /> password will remain the same. Nothing to worry about.
			</p>
		</div>
		<p style="text-align: center;font-size: 13px;">
			If the “Reset Password” button doesn’t display, please copy the following URL in your web browser: <br/>
			<a style="text-decoration: none;" href="{{ url('/password/reset/').'/'.$token }}">{{ url('/password/reset/').'/'.$token }}</a>
		</p>
		<hr style="border-top: 1px solid #707070;background: none;margin-top: 30px;margin-bottom: 30px;">
		<p style="text-align: center;">
			<a style="text-decoration: none;" href="https://www.facebook.com/ShareThisRide/"><img src="{{ url('/').'/public/images/face.jpg' }}" /> </a>
			<a style="text-decoration: none;" href="https://twitter.com/sharethisride"><img src="{{ url('/').'/public/images/twitter.jpg' }}" /> </a>
			<a style="text-decoration: none;" href="https://www.instagram.com/sharethisride_/?hl=en"><img src="{{ url('/').'/public/images/insta.jpg' }}" /> </p> </a>
		<p style="text-align: center;font-size: 13px;">
			Problems or questions? Send us an e-mail at <a style="text-decoration: none;" href="{{ url('/sendMail').'/support@sharethisride.com' }}" target="_blank">support@sharethisride.com</a>
		</p>
		<p style="text-align: center;">
			© 2018 ShareThisRide | Møntergade 4, 1116 København, Denmark
		</p>
	</body>
</html>