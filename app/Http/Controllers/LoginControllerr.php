<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Hash;


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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();
        $teacher = Teacher::where('email', '=', $email)->first();
        if ($user != null) {
            $passwordMatch = Hash::check($password, $user->password);
            if ($passwordMatch) {
                // Auth::login($admin);
                $username = $user->username;

                return redirect("/a/home");
            } else {
                return redirect("/");
            }
        } elseif ($user == null && $teacher != null) {
            $passwordMatch = Hash::check($password, $teacher->password);
            if ($passwordMatch) {
                // Auth::login($admin);
                $username = $teacher->username;

                return redirect("/t/home");
            } else {
                return redirect("/");
            }
        } else {
            return redirect('/');
        }
    }
}
