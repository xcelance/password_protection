<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;
use App\User;
use App\Urls;
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
        return view('admin.admin-details')->with('admin', $admin);
    }

    /**
     * View create User page.
     *
     * @return void
     */
    public function updateAdmin(Request $request, $a_id) {
        $id = base64_decode($a_id);

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

        if ($validator->fails()) {
           $errors = $validator->errors(); 
           return redirect()->back()->withErrors($errors)->withInput();
        }

        if(User::where('id', $id)->where('email', $request['email'])->count() > 0) {
            $admin->update([ 'name' => $request['name'] ]);
            if(!empty($request['password'])) {
                $password = bcrypt($request['password']);
                $admin->update([ 'password' => $password ]);
            }
            Session::flash('success', 'Admin updated sucessfully.');
            return redirect()->back();
        } else {
            if(User::where('email', $request['email'])->count() > 0) {
                Session::flash('warning', 'Email has already been taken.');
                return redirect()->back();
            } else { 
                $admin->update([ 'name' => $request['name'], 'email' => $request['email'] ]);
                if(!empty($request['password'])) {
                    $password = bcrypt($request['password']);
                    $admin->update([ 'password' => $password ]);
                }

                Session::flash('success', 'Admin updated sucessfully.');
                return redirect()->back();
            }
        }
        
    }

    /**
     * View create User page.
     *
     * @return void
     */
    public function activate($u_id) {
        $id = base64_decode($u_id);

        if(User::where('id', $id)->where('active', '0')->count() > 0) {
            // deactivate user
            User::where('id', $id)->update([ 'active' => '1' ]);
            Session::flash('success', 'User is deactivated.');
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
    	return view('admin.create-user')->with('urls', $urls);
    }

    /**
     * Create new user.
     *
     * @return void
     */
    public function createUser(Request $request) {
    	$rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:63|unique:users',
            'password' => 'required|min:8|string|confirmed',
            'url' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
           $errors = $validator->errors(); 
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
        	Session::flash('error', 'Unable to create new user.');
            return redirect()->back();
        }
    }

    /**
     * List all the users accept admin.
     *
     * @return void
     */
    public function users() {
    	$users = User::where('role', '!=', '0')->paginate(200);
    	return view('admin.users')->with('users', $users);
    }

    /**
     * Delete user.
     *
     * @return void
     */
    public function deleteUser($u_id) {
        $id = base64_decode($u_id);

    	if(User::where('id', $id)->delete()) {
    		Session::flash('success', 'User deleted sucessfully.');
            return redirect()->back();
    	} else {
    		Session::flash('error', 'Something went wrong while deleting user.');
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

        $urls = Urls::all();
    	$user = User::where('id', $id)->first();
    	return view('admin.edit-user')->with('user', $user)->with('urls', $urls);
    }

    /**
     * Update Particular user
     *
     * @return void
     */
    public function updateUser(Request $request, $u_id) {
        $id = base64_decode($u_id);

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

        if ($validator->fails()) {
           $errors = $validator->errors(); 
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
        		Session::flash('error', 'Email has already been taken.');
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

    	if(Urls::where('url', $request['url'])->count() > 0) {
    		Session::flash('warning1', 'Url already exists.');
        	return redirect()->back();
    	} else {

    		$url = new Urls;

    		$url->url = $request['url'];

    		if($url->save()) {
	    		Session::flash('success1', 'User updated sucessfully.');
	        	return redirect()->back();
	        } else {
	        	Session::flash('error1', 'Url already exists.');
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

        if(Urls::where('id', $id)->delete()) {
            Session::flash('success', 'Url deleted sucessfully.');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong while deleting url.');
            return redirect()->back();
        }

    }

    /**
     * get reset Url
     *
     * @return void
     */
    public function getReset() {
        return view('auth.passwords.email');
    }

    /**
     * send reset password Url
     *
     * @return void
     */
    public function resetPassword(Request $request) { 
        $rules = [
            'email' => 'required|email|max:63',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors(); 
            return redirect()->back()->withErrors($errors)->withInput();
        }

        if(User::where('email', $request['email'])->count() > 0) {
            $data = array( 'email' => $request['email'], 'status' => "reset");
            if(Reset::where('email', $request['email'])->count() > 0) {
                // already exists
                Session::flash('error', 'No user has been registered with this email.');
                return redirect()->back();
            } else {
                // create reset value
                $reset = new Reset;

                $reset->email = $request['email'];
                if($reset->save()) {
                    // send mails
                    Mail::send('emails.reset', $data, function($message) use ($data) {
                        $message->from($data['email']);
                        $message->to('no-reply@sharethisride.com')->subject('ShareThisRide: Forgotten Password');
                    });

                    // unable to create notification
                    Session::flash('success', 'Request has been sent.');
                    return redirect()->back();
                } else {
                    // unable to create notification
                    Session::flash('error', 'Unable to create request.');
                    return redirect()->back();
                }
            }

        } else {
            // not user with this mail
            Session::flash('error', 'No user has been registered with this email.');
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

        if ($validator->fails()) {
            $errors = $validator->errors(); 
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
                Session::flash('error', 'No user has been registered with this email.');
                return redirect()->back();
            }
        } else {
            // not user with this mail
            Session::flash('error', 'No such user called for password reset request..');
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

}
