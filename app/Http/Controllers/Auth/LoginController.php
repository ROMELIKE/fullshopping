<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password,
            'accessible' => [1,2],
        ];
        if (Auth::attempt($login)) {
            return redirect()->route('admin.dashboard')->with([
                'level' => 'success',
                'message' => 'Well come back Admin'
            ]);
        } else {
            return redirect()->back()->with([
                'level' => 'danger',
                'message' => 'Username or Password do not match, try again!'
            ]);

        }
    }
}
