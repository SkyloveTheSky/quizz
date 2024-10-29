<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hashids\Hashids;



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
    protected function redirectTo()
{
    if (auth()->user()) {
        $hashids = new Hashids(12); // Initialise Hashids
        $hashedUserId = $hashids->encode(auth()->user()->id); // Hash l'user_id

        return route('user.home', ['hashed_user_id' => $hashedUserId]);
    }

    return '/home'; // Redirection par défaut si l'utilisateur n'est pas authentifié
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticate(Request $request, $user)
    {
        return redirect()->intended("/home/{$user->id}");
    }
}
