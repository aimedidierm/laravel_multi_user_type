<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Teacher;
use App\User;

class LoginController extends Controller
{
    //
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
                Auth::login($user);
                $data = Auth::id();
                return view('ahome', ["data" => $data]);
            } else {
                return redirect("/");
            }
        } elseif ($user == null && $teacher != null) {
            $passwordMatch = Hash::check($password, $teacher->password);
            if ($passwordMatch) {
                Auth::guard("teacher")->login($teacher);
                return redirect("/t/home");
            } else {
                return redirect("/");
            }
        } else {
            return redirect('/');
        }
    }
}
