<?php
namespace App\Http\Controllers; 

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\User;
use App\Reset;
use App\Error;
use Session;

class UserController extends Controller { 

	// use Session;
	public function __construct() {}

	/**
     * index controller
     *
     * @return void
    */
    public function index() {
    	return view('welcome');
    }

	/**
     * login controller function
     *
     * @return void
    */
    public function login(Request $request) {
    	$error = Error::where('type', 'Login Error')->first();
        if(Auth::check()) {
            return redirect('/');
        }

        if (Auth::attempt(array( 'email' => $request['email'], 'password' => $request['password'], 'active' => '0' ))) {			
            if (Auth::user()->role == "0") {
                return redirect('/users');
            } else { 
                $url = Auth::user()->url;  

               $reqUrl = $_SERVER['HTTP_REFERER'];
               if(strpos($reqUrl, 'request_uri_path') != false){
                   $refUrl = explode("request_uri_path=", $reqUrl);
                   setcookie('email', $request['email'], time()+3600, "/", ".sharethisride.com");
                   return '<script> window.location.href = "'.$refUrl[1].'"; </script>';
               }else{
                setcookie('email', $request['email'], 0, "/");
                  return redirect($url);    
                }                
            }
        } else {
            Session::flash('error', $error->text);
            return redirect('/');
        }
    }

    /**
     * logout function
     *
     * @return void
    */
    public function logout() {
    	setcookie('email', null, -1, "/");
        Auth::logout();
        return redirect('/');
         
    }

    /**
     * get reset Url
     *
     * @return void
     */
    public function getReset() { 
        if(Auth::check()) {
            return redirect('/');
        }
        $error = Error::where('type', 'Error')->first();
        return view('auth.passwords.email')->with('error', $error);
    }

    /**
     * send reset mail
     *
     * @return void
    */
    public function sendResetLinkEmail(Request $request) {
        if(Auth::check()) {
            return redirect('/');
        }

        $request['email'] = $request['mail'];
        $token = str_random(64);

        $rules = [
            'email' => 'required|email|max:63',
        ];

        $validator = Validator::make(Input::all(), $rules);
        $error = Error::where('type', 'Error')->first();

        if ($validator->fails()) {
            $errors = $validator->errors(); 
            return redirect()->back()->withErrors($errors)->withInput();
        }

       

        if(User::where('email', $request['email'])->count() > 0) {
            $user = User::where('email', $request['email'])->first();
            
            if(Reset::where('email', $request['email'])->count() > 0) {
                // already exists
                $reset = Reset::where('email', $request['email'])->first();

                $html = $this->createHtml($token,$reset->id);

                $data = array( 'id' => $reset->id, 'email' => $request['email'],'token' => $token );
                Reset::where('email', $request['email'])->update([ 'token' => $token, 'html' => $html ]);
                Mail::send('emails.reset', $data, function($message) use ($data) {
                    $message->to($data['email'])->subject('ShareThisRide: Forgotten Password');
                });
                // created notification
                Session::flash('success', 'Please check your email.');
                return redirect()->back();
            } else {
                // create reset value
                $reset = new Reset;

                $reset->email = $request['email'];
                $reset->token = $token;
                if($reset->save()) {
                   
                    $data = array( 'id' => $reset->id, 'email' => $request['email'],'token' => $token );
                    $html = $this->createHtml($token,$reset->id);
                    Reset::where('id', $reset->id)->update([ 'html' => $html ]); 
                    // send mails
                    Mail::send('emails.reset', $data, function($message) use ($data) {
                        $message->to($data['email'])->subject('ShareThisRide: Forgotten Password');
                    });
                    // created notification
                    Session::flash('success', 'Request has been sent.');
                    return redirect()->back();
                } else {
                    // unable to create notification
                    Session::flash('error', $error->text);
                    return redirect()->back();
                }
            }

        } else {
            Session::flash('error', $error->text);
            return redirect()->back();
        }
    }

    /**
     * generate password
     *
     * @return void
    */
    public function checkForUrl($token) {
        if(Auth::check()) {
            return redirect('/');
        }

        // check weather the token has been expired or not
        $validateToken = $this->validateTokenTime($token);
        if($validateToken == "expired") {
            return redirect('/password/reset/expired');
        }
        $error = Error::where('type', 'Error')->first();
        $perr = Error::where('type', 'Password Error')->first();

        return view('auth.passwords.reset')->with('token', $token)->with('error', $error)->with('perr', $perr);
    }

    /**
     * create new password
     *
     * @return void
    */
    public function createNewPassword(Request $request, $token) {
        if(Auth::check()) {
            return redirect('/');
        }
 
        $request['email'] = $request['mail'];
        $request['password'] = $request['passwrd'];

        $rules = [
            'email' => 'required|email|max:63',
            'password' => 'required|min:8|string|confirmed',
        ];

        $validator = Validator::make(Input::all(), $rules);
        $error = Error::where('type', 'Error')->first();
        
        // validate input fields.
        if ($validator->fails()) {
            $errors = $validator->errors(); 
            return redirect()->back()->withErrors($errors)->withInput();
        }

        if(Reset::where('email', $request['email'])->where('token', $token)->count() > 0) {
            if(User::where('email', $request['email'])->count() > 0) {
                $user = User::where('email', $request['email']);
                // check if password and confirm password are same or not
                if(!empty($request['password']) && !empty($request['password_confirmation'])) {
                    if($request['password'] == $request['password_confirmation']) {
                        $password = bcrypt($request['password']);
                        $password_show = base64_encode($request['password']);
                        $user->update([ 'password' => $password, 'password_show' => $password_show ]);
                        // delete the reset details
                        Reset::where('email', $request['email'])->where('token', $token)->delete();

                        Session::flash('success', 'Password updated sucessfully.');
                    } else {
                        Session::flash('error', $error->text);
                    }
                } else {
                    Session::flash('error', $error->text);
                }
                // return it back
                return redirect()->back();
            } else {
                Session::flash('error', $error->text);
                return redirect()->back();
            }
        } else {
            Session::flash('error', $error->text);
            return redirect()->back();
        }

    }

    /**
     * create html for 
     *
     * @return void
    */
    public function createHtml($token,$id) {

        // mail template html
        $html = "";
    
        $html .=  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>INDEX</title>
                    <link href="'.url('/').'/public/css/style.css" rel="stylesheet">
                </head>

                <body>

                    <div class="view_mail" style="width: 70%;margin: 0 auto;clear: both;text-align: center;padding: 20px;">
                        <a href="'.url('/').'" style="text-decoration: none;color: #000000;"><h3 style="font-size: 24px;">ShareThisRide</h3></a>
                        <h1 style="font-size: 43px; font-weight: 800;">Forgot your password?</h1>
                        <p style="font-size: 27px; font-weight: 600;">
                            It’s ok, it happens to the best of us. Just click <br/> on the link below to reset your password.
                        </p>
                        <a href="'.url('/password/reset/').'/'.$token.'" style="text-decoration: none;">
                            <button type="button" style="width: 37%;height: 60px;color: #ffff;border: 1px solid #707070;font-size: 18px;background: #C6C6C6;font-weight: 600;margin: 0 auto;clear: both;display: block; cursor: pointer;">
                            Reset Password
                            </button> 
                        </a>
                        <p style="font-size: 19px;">
                            If you didn’t make this request, delete this e-mail and your<br /> password will remain the same. Nothing to worry about.
                        </p>
                    </div>
                    <p style="text-align: center;font-size: 14px;">
                        If the “Reset Password” button doesn’t display, please copy the following URL in your web browser: <br/>
                        <pre>
                        <a style="text-decoration: none;" href="'.url('/password/reset/').'/'.$token.'">'.url('/password/reset/').'/'.$token.'</a>
                        </pre>
                    </p>
                    <hr style="width: 63%;border-top: 1px solid #707070;background: none;margin-top: 30px;margin-bottom: 30px;">
                    <p style="text-align: center;">
                        <a style="text-decoration: none;" href="https://www.facebook.com/ShareThisRide/"><img src="'.url('/').'/public/images/face.jpg'.'" /> </a>
                        <a style="text-decoration: none;" href="https://twitter.com/sharethisride"><img src="'.url('/').'/public/images/twitter.jpg'.'" /> </a>
                        <a style="text-decoration: none;" href="https://www.instagram.com/sharethisride_/?hl=en"><img src="'.url('/').'/public/images/insta.jpg'.'" /> </p> </a>
                    <p style="text-align: center; font-size: 14px;">
                        Problems or questions? Send us an e-mail at <a style="text-decoration: none;" href="'.url('/sendMail').'/support@sharethisride.com'.'" target="_blank">support@sharethisride.com</a>
                    </p>
                    <p style="text-align: center;">
                        © 2018 ShareThisRide | Møntergade 4, 1116 København, Denmark
                    </p>
                </body>
            </html>';

        return $html;
    }

    /**
     * view mail html
     *
     * @return void
    */
    public function viewMailHtml($rid) {
        $id = base64_decode($rid);
        $reset = Reset::where('id', $id)->first();
        if(!empty($reset)) {
            echo $reset->html;
        } else {
            return redirect('/');
        }
    }

    /**
     * check for 24 hours validation
     *
     * @return void
    */
    public function validateTokenTime($token) {
    	// get token validation
    	if(Reset::where('token', $token)->count() > 0) {
	    	$reset = Reset::where('token', $token)->first();

	    	date_default_timezone_set('UTC'); 
	        $date_two = date('Y-m-d H:i:s ', time());

	        $minutes = round((strtotime($date_two) - strtotime($reset->updated_at)) / 60,2);
	        $hours = round((strtotime($date_two) - strtotime($reset->updated_at))/(60*60));

	        if($hours >= 24) {
	            return "expired";
	        } else {
	            return "working";
	        }
	    } else {
	    	return "working";
	    }
    } 

    /**
     * send mail popup
     *
     * @return void
    */
    public function sendMail($email) {
        echo '<script> window.location.href = "mailto:'.$email.'"; </script>';
    }

    /**
     * make api request
     *
     * @return void
    */
    public function expiredToken() {
    	if(Auth::check()) {
            return redirect('/');
        }
        $error = Error::where('type', 'Error')->first();
        return view('auth.passwords.expire')->with('error', $error);
    }

    public function test() {
        $to_time = strtotime("2008-12-13 10:42:00");
		$from_time = strtotime("2008-12-13 10:21:00");
		echo round(abs($to_time - $from_time) / 60,2). " minute";
    }

}