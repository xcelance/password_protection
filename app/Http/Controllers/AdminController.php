<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;
use App\User;
use App\Urls;
use App\Error;
use App\Reset;
use Session;

class AdminController extends Controller
{
    /**
     * index controller.
     *
     * @return void
     */
    public function index() {
    	return view('admin.dashboard');
    }

    /**
     * View create User page.
     *
     * @return void
     */
    public function adminEdit() {
        $admin = User::where('id', Auth::user()->id)->where('role', '0')->first();
        $error = Error::first();

        return view('admin.admin-details')->with('admin', $admin)->with('error', $error);
    }

    /**
     * View create User page.
     *
     * @return void
     */
    public function updateAdmin(Request $request, $a_id) {
        $id = base64_decode($a_id);
        
        $request['password'] = $request['passwrd'];
        $request['email'] = $request['mail'];

        if($request['password'] == "") {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:63',
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:63',
                'password' => 'required|min:8|string|confirmed',
            ];
        }

        $validator = Validator::make(Input::all(), $rules);

        $admin = User::where('id', $id); 
        $error = Error::first();

        if ($validator->fails()) {
           $errors = $validator->errors();
            Session::flash('error', $error->text);
           return redirect()->back()->withErrors($errors)->withInput();
        }

        if(User::where('id', $id)->where('email', $request['email'])->count() > 0) {
            $admin->update([ 'name' => $request['name'] ]);
            if(!empty($request['password']) && !empty($request['password_confirmation'])) {
                if($request['password'] == $request['password_confirmation']) {
                    $password = bcrypt($request['password']);
                    $password_show = base64_encode($request['password']);
                    $admin->update([ 'password' => $password, 'password_show' => $password_show ]);
                }
            }
            Session::flash('success', 'Admin updated sucessfully.');
            return redirect()->back();
        } else {
            if(User::where('email', $request['email'])->count() > 0) {
                Session::flash('error', $error->text);
                return redirect()->back();
            } else { 
                $admin->update([ 'name' => $request['name'], 'email' => $request['email'] ]);
                if(!empty($request['password']) && !empty($request['password_confirmation'])) {
                    if($request['password'] == $request['password_confirmation']) {
                        $password = bcrypt($request['password']);
                        $password_show = base64_encode($request['password']);
                        $admin->update([ 'password' => $password, 'password_show' => $password_show ]);
                    }
                }

                Session::flash('success', 'Admin updated sucessfully.');
                return redirect()->back();
            }
        }
        
    }

    /**
     * activate or deactivate user.
     *
     * @return void
     */
    public function activate($u_id) {
        $id = base64_decode($u_id);

        if(User::where('id', $id)->where('active', '0')->count() > 0) {
            // deactivate user
            User::where('id', $id)->update([ 'active' => '1' ]);
            Session::flash('warning', 'User is deactivated.');
        } else {
            // activate user
            User::where('id', $id)->update([ 'active' => '0' ]);
            Session::flash('success', 'User is activated.');
        }
        // return back to url
        return redirect()->back();
    }

    /**
     * View create User page.
     *
     * @return void
     */
    public function addUser() {

        $urls = Urls::all();
        $error = Error::first();

    	return view('admin.create-user')->with('urls', $urls)->with('error', $error);
    }

    /**
     * Create new user.
     *
     * @return void
     */
    public function createUser(Request $request) {

        $request['password'] = $request['passwrd'];
        $request['email'] = $request['mail'];

    	$rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:63|unique:users',
            'password' => 'required|min:8|string|confirmed',
            'url' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);
        $error = Error::first();

        if ($validator->fails()) {
           $errors = $validator->errors();
           Session::flash('error', $error->text); 
           return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = new User;

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->password_show = base64_encode($request['password']);
        $user->url = $request['url'];

        if($user->save()) {
			Session::flash('success', 'New user created sucessfully.');
            return redirect()->back();
        } else {
        	Session::flash('error', $error->text);
            return redirect()->back();
        }
    }

    /**
     * List all the users accept admin.
     *
     * @return void
     */
    public function users() {
    	$users = User::where('role', '!=', '0')->get();
    	return view('admin.users')->with('users', $users);
    }

    /**
     * Delete user.
     *
     * @return void
     */
    public function deleteUser($u_id) {
        $id = base64_decode($u_id);

        $error = Error::first();

    	if(User::where('id', $id)->delete()) {
    		Session::flash('success', 'User deleted sucessfully.');
            return redirect()->back();
    	} else {
    		Session::flash('error', $error->text);
            return redirect()->back();
    	}
    }

    /**
     * Edit particular user.
     *
     * @return void
     */
    public function editUser($u_id) {
        $id = base64_decode($u_id);
        $error = Error::first();
        $urls = Urls::all();
    	$user = User::where('id', $id)->first();
        
    	return view('admin.edit-user')->with('user', $user)->with('urls', $urls)->with('error', $error);
    }

    /**
     * Update Particular user
     *
     * @return void
     */
    public function updateUser(Request $request, $u_id) {
        $id = base64_decode($u_id);

        $request['password'] = $request['passwrd'];
        $request['email'] = $request['mail'];

    	if($request['password'] == "" || $request['password_confirmation'] == "") {
	    	$rules = [
	            'name' => 'required|string|max:255',
	            'email' => 'required|email|max:63',
	            'url' => 'required',
	        ];
	    } else {
	    	$rules = [
	            'name' => 'required|string|max:255',
	            'email' => 'required|email|max:63',
	            'password' => 'required|min:8|string|confirmed',
	            'url' => 'required',
	        ];
	    }

        $validator = Validator::make(Input::all(), $rules);

        $current_user = User::where('id', $id); 
        $error = Error::first();

        if ($validator->fails()) {
           $errors = $validator->errors(); 
           Session::flash('error', $error->text);
           return redirect()->back()->withErrors($errors)->withInput();
        }

        if(User::where('id', $id)->where('email', $request['email'])->count() > 0) {
        	$current_user->update([ 'name' => $request['name'], 'url' => $request['url'] ]);
    		if(!empty($request['password']) && !empty($request['password_confirmation'])) {
                if($request['password'] == $request['password_confirmation']) {
        			$password = bcrypt($request['password']);
                    $password_show = base64_encode($request['password']);
        			$current_user->update([ 'password' => $password, 'password_show' => $password_show ]);
                }
    		}
    		Session::flash('success', 'User updated sucessfully.');
        	return redirect()->back();
        } else {
        	if(User::where('email', $request['email'])->count() > 0) {
        		Session::flash('error', $error->text);
        		return redirect()->back();
        	} else { 
        		$current_user->update([ 'name' => $request['name'], 'url' => $request['url'], 'email' => $request['email'] ]);
        		// $current_user->save();
        		if(!empty($request['password']) && !empty($request['password_confirmation'])) {
                    if($request['password'] == $request['password_confirmation']) {
            			$password = bcrypt($request['password']);
                        $password_show = base64_encode($request['password']);
            			$current_user->update([ 'password' => $password, 'password_show' => $password_show ]); 
                    }
        		}

        		Session::flash('success', 'User updated sucessfully.');
        		return redirect()->back();
        	}
        }

    }

    /**
     * get all urls
     *
     * @return void
     */
    public function getUrls() {

    	$urls = Urls::paginate(10);
    	return view('admin.urls')->with('urls', $urls);

    }

    /**
     * add new url
     *
     * @return void
     */
    public function addUrl(Request $request) {
        $error = Error::first();

    	if(Urls::where('url', $request['url'])->count() > 0) {
    		Session::flash('error1', $error->text);
        	return redirect()->back();
    	} else {

    		$url = new Urls;

    		$url->url = $request['url'];

    		if($url->save()) {
	    		Session::flash('success1', 'User updated sucessfully.');
	        	return redirect()->back();
	        } else {
	        	Session::flash('error1', $error->text);
        		return redirect()->back();
	        }
    	}

    }

    /**
     * Delete Url
     *
     * @return void
     */
    public function deleteUrl($Uid) {
        $id = base64_decode($Uid);
        $error = Error::first();

        if(Urls::where('id', $id)->delete()) {
            Session::flash('success', 'Url deleted sucessfully.');
            return redirect()->back();
        } else {
            Session::flash('error', $error->text);
            return redirect()->back();
        }

    }

    /**
     * open generate password
     *
     * @return void
     */
    public function createPassword() {
        return view('auth.passwords.reset');
    }

    /**
     * generate new password
     *
     * @return void
     */
    public function generatePassword(Request $request) { 
        $rules = [
            'email' => 'required|email|max:63',
            'password' => 'required|min:8|string|confirmed'
        ];

        $validator = Validator::make(Input::all(), $rules);
        $error = Error::first();

        if ($validator->fails()) {
            $errors = $validator->errors(); 
            Session::flash('error', $error->text);
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = User::where('email', $request['email'])->first();

        if(Reset::where('email', $request['email'])->count() > 0) {
            if(User::where('email', $request['email'])->count() > 0) {
                $data = array( 
                    'email' => $request['email'], 
                    'name' => $user->name,
                    'password' => $request['password'], 
                    'status' => "generate"
                );

                $password = bcrypt($request['password']);
                $password_show = base64_encode($request['password']);
                User::where('email', $request['email'])->update(['password' => $password, 'password_show' => $password_show ]);

                Reset::where('email', $request['email'])->delete();

                // send mails
                Mail::send('emails.reset', $data, function($message) use ($data) {
                    $message->from('no-reply@sharethisride.com');
                    $message->to($data['email'])->subject('ShareThisRide: Forgotten Password');
                });

                // user updated
                Session::flash('success', 'Password has been updated successfully.');
                return redirect()->back();
            } else {
                // not user with this mail
                Session::flash('error', $error->text);
                return redirect()->back();
            }
        } else {
            // not user with this mail
            Session::flash('error', $error->text);
            return redirect()->back();
        }
    }

    /**
     * generate new password
     *
     * @return void
     */
    public function notification() {
        $notifications = Reset::all();
        
        if(Reset::where('status', '0')->count() > 0) {
            Reset::where('status', '0')->update([ 'status' => '1' ]);
        }
        return view('admin.notification')->with('notifications', $notifications);
    }

    /**
     * get notification
     *
     * @return void
     */
    public function getnotification() {
        echo $notifications = Reset::where('status', '0')->count();
    }

    /**
     * get notification
     *
     * @return void
     */
    public function viewError() {
        $error = Error::where('type', 'Error')->first();
        $perror = Error::where('type', 'Password Error')->first();
        $lerror = Error::where('type', 'Login Error')->first();
        $teerror = Error::where('type', 'Token Expired Error')->first();

        return view('admin.error')->with('error', $error)->with('perror', $perror)->with('lerror', $lerror)->with('teerror', $teerror);
    }

    /**
     * get notification
     *
     * @return void
     */
    public function editError(Request $request) {
        $error = Error::where('type', 'Error')->first();

        Error::where('type', 'Error')->update( ['text' => $request['error'] ]);
        Error::where('type', 'Password Error')->update( ['text' => $request['password_error'] ]);
        Error::where('type', 'Login Error')->update( ['text' => $request['login_error'] ]);
        Error::where('type', 'Token Expired Error')->update( ['text' => $request['tokenex_error'] ]);

        Session::flash('success', 'error messages has been updated.');
        return redirect()->back();
    }

}
