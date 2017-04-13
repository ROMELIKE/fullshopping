<?php

namespace App\Http\Controllers\User;

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
        $array = [
            'name' => strip_tags(trim($request->fullname)),
            'username' => strip_tags(trim($request->username)),
            'email' => strip_tags(trim($request->email)),
            'phone' => strip_tags(trim($request->phone)),
            'address' => strip_tags(trim($request->address)),
            'status' => 0,
            'accessible' => 0,
            'date' => date("y-m-d H:i:s"),
            'password' => Hash::make($request->password),
        ];

        //Handle avatar.
        if (isset($request->avatar) && $request->avatar) {
            $avatar = $request->avatar->getClientOriginalName();

            //move this image to folder.
            $request->avatar->move('admin/images/avatars', $avatar);

            //add to $array.
            $array['avatar'] = $avatar;
        }

        $model = new User();
        $addUser = $model->AddNewUser($array);

    }
}
