<?php

namespace App\Http\Controllers\User;

use App\Business\UserObject;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('user.page.register');
    }

    public function postRegister(UserRegisterRequest $request)
    {
        //get variable input:
        $user = new UserObject();
        if (isset($request->fullname) && $request->fullname) {
            $user->name = strip_tags(trim($request->fullname));
        }
        if (isset($request->username) && $request->username) {
            $user->username = strip_tags(trim($request->username));
        }
        if (isset($request->email) && $request->email) {
            $user->email = strip_tags(trim($request->email));
        }
        if (isset($request->phone) && $request->phone) {
            $user->phone = strip_tags(trim($request->phone));
        }
        if (isset($request->address) && $request->address) {
            $user->address = strip_tags(trim($request->address));
        }
        if (isset($request->password) && $request->password) {
            $user->password = Hash::make($request->password);
        }
        if (isset($request->status) && $request->status) {
            $user->status = $request->status;
        } else {
            $user->status = 0;
        }
        if (isset($request->accessible) && $request->accessible) {
            $user->accessible = $request->accessible;
        } else {
            $user->accessible = 0;
        }
        if (isset($request->date) && $request->date) {
            $user->date = $request->date;
        } else {
            $user->date = date("y-m-d H:i:s");
        }
        //Handle avatar.
        if (isset($request->avatar) && $request->avatar) {
            $avatar = imageHandle($request->avatar,'admin/images/avatars');
            $user->avatar = $avatar;
        }

        $model = new User();
        //call to addnewuser in model and get return values
        $addUser = $model->AddNewUser($user);
        if ($addUser->messageCode) {
            return redirect()->route('usergetlogin')->with([
                'level' => 'success',
                'message' => 'Register successfully, need the checking of admin!',
            ]);
        } else {
            return redirect()->route('usergetlogin')->with([
                'level' => 'danger',
                'message' => 'Sorry, But you cannot register now!',
            ]);
        }
    }
}
