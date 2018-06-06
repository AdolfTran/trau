<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;

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
        $inputs = $request->only('email', 'password');
        $auth = \Auth::guard();
        if ($auth->attempt($inputs))
        {
            $email = $auth->email;
            $title = "Mật khẩu đã được thay đổi";
            $_password = rand(111111, 999999);
            $password = bcrypt($_password);
            User::where('email', $email)->update(['password', $password]);
            Mail::send('meails.password', $_password, function ($message) use ($email, $title) {
                $message->to($email, !empty($auth['name']) ? $auth['name'] : "")->subject($title);
            });
            return redirect(route('dashboard'));
        }
        return redirect()->back()->with('error', "Email hoặc mật khẩu sai!");
    }
}
