<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('user.page.login');
    }

    public function postLogin(UserLoginRequest $request)
    {
        $login = [
            'username' => strip_tags(trim($request->username)),
            'password' => strip_tags(trim($request->password)),
            'accessible' => 0,
        ];
        if (Auth::guard('simpleUser')->attempt($login)) {
            return redirect()->route('gethome')->with([
                'level' => 'success',
                'message' => 'Well come GiftShop'
            ]);
        } else {
            return redirect()->back()->with([
                'level' => 'danger',
                'message' => 'Username or Password do not match, try again!'
            ]);

        }
    }
}
