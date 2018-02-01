<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function change(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->input();
        $curPassword = $inputs['piCurrPass'];
        $newPassword = $inputs['piNewPass'];
        $confirmPassword = $inputs['piNewPassRepeat'];

        if (Hash::check($curPassword, $user->password) && ($newPassword === $confirmPassword)) {
            $user_id = $user->id;
            $obj_user = User::find($user_id)->first();
            $obj_user->password = Hash::make($newPassword);
            $obj_user->save();
            Flash::success('The password is changed');
            return view('auth.profile');
        }
        else
        {
            Flash::error('The password not changed');
            return view('auth.profile');
        }
    }
}
