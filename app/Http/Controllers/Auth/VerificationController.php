<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Hashids\Hashids;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->check()) {
            $hashids = new Hashids('', 12); // Initialise Hashids avec une longueur minimale
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
