<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Hashids\Hashids;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user(); // Récupère l'utilisateur authentifié
        $hashids = new Hashids();
        $hashed_user_id = $hashids->encode($user->id);
        return view('home', compact('user', 'hashed_user_id'));
    }

    /**
     * Show the user dashboard based on hashed user_id.
     *
     * @param  string  $hashed_user_id
     * @return \Illuminate\Http\Response
     */
    public function show($hashed_user_id)
    {
        $hashids = new Hashids();
        $userId = $hashids->decode($hashed_user_id)[0];
        $user = User::findOrFail($userId);
        return view('home', compact('user'));
    }
    public function showFlashcardMain($hashed_user_id)
    {
        return view('flashcards_quizz.flashcardMain', compact('hashed_user_id'));
    }
}
