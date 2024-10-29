<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hashids\Hashids;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Profile;

class GoogleController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    protected $hashids;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->hashids = new Hashids('', 13);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                $hashed_user_id = $this->hashids->encode($finduser->id);

                return redirect()->route('user.home', ['hashed_user_id' => $hashed_user_id]);
            } else {

                $newUser = User::updateOrCreate(['email' => $user->getEmail()], [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'password' => encrypt('123456dummy')
                ]);



                Log::info('New user created:', ['user_id' => $newUser->id]);
                Auth::login($newUser);
                $hashed_user_id = $this->hashids->encode($newUser->id);
                Log::info('Redirecting new user to home.', ['hashed_user_id' => $hashed_user_id]);
                return redirect()->route('user.home', ['hashed_user_id' => $hashed_user_id]);
            }
        } catch (Exception $e) {

            dd('Erreur est humaine: ' . $e->getMessage());
        }
    }
}
