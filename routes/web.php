<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Face;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ListeningController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StudentListeningController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view ('welcome');
});
//Authentification----------------------------------------------------------------------------------
Auth::routes([
    'verify'=>true
]);
Auth::routes(['verify' => true]);
Route::get('/verify/{hashed_user_id}', [RegisterController::class, 'showVerification'])->name('user.verify');
Route::get('/home/{hashed_user_id}', [HomeController::class, 'index'])->name('user.home');
Route::get('home/{hashed_user_id}', [HomeController::class, 'index'])->name('user.home')->middleware('auth', 'verified');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//endAuthentification----------------------------------------------------------------------------------

//Route socialite-----------------------------------------------------------------------------------
//Route Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
//Route Facebook
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->name('handleFacebookCallback');
//endRoute socialite-----------------------------------------------------------------------------------


//Route admin---------------------------------------------------------------------------------------
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register'])->name('admin.register.post');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard/{admin_id}', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    });
});
Route::prefix('admin')->group(function () {
    Route::get('flashcards', [FlashcardController::class, 'index'])->name('flashcards.index');
    Route::get('flashcards/create', [FlashcardController::class, 'create'])->name('flashcards.create');
    Route::post('flashcards', [FlashcardController::class, 'store'])->name('flashcards.store');
    Route::get('flashcards/{flashcard}/edit', [FlashcardController::class, 'edit'])->name('flashcards.edit');
    Route::put('flashcards/{flashcard}', [FlashcardController::class, 'update'])->name('flashcards.update');
    Route::delete('flashcards/{flashcard}', [FlashcardController::class, 'destroy'])->name('flashcards.destroy');
    Route::get('flashcards/level/{level}', [FlashcardController::class, 'indexByLevel'])->name('flashcards.level');
});

Route::prefix('admin')->group(function () {
    Route::get('listenings', [ListeningController::class, 'index'])->name('listenings.index');
    Route::get('listenings/create', [ListeningController::class, 'create'])->name('listenings.create');
    Route::post('listenings', [ListeningController::class, 'store'])->name('listenings.store');
    Route::get('listenings/{listening}/edit', [ListeningController::class, 'edit'])->name('listenings.edit');
    Route::put('listenings/{listening}', [ListeningController::class, 'update'])->name('listenings.update');
    Route::delete('listenings/{listening}', [ListeningController::class, 'destroy'])->name('listenings.destroy');
    Route::get('listenings/level/{level}', [ListeningController::class, 'indexByLevel'])->name('listenings.level');
});

Route::prefix('admin')->group(function () {
    Route::get('files', [FileController::class, 'index'])->name('files.index');
    Route::get('files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('files', [FileController::class, 'store'])->name('files.store');
    Route::delete('files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
});
Route::prefix('admin')->group(function () {
    Route::get('pdfs', [PdfController::class, 'index'])->name('pdfs.index');
    Route::get('pdfs/create', [PdfController::class, 'create'])->name('pdfs.create');
    Route::post('pdfs', [PdfController::class, 'store'])->name('pdfs.store');
    Route::get('pdfs/{pdf}/edit', [PdfController::class, 'edit'])->name('pdfs.edit');
    Route::put('pdfs/{pdf}', [PdfController::class, 'update'])->name('pdfs.update');
    Route::delete('pdfs/{pdf}', [PdfController::class, 'destroy'])->name('pdfs.destroy');
});

//endRoute admin-------------------------------------------------------------------------------------

//Route flashcards_quizz-----------------------------------------------------------------------------
Route::get('/home/{hashed_user_id}/flashcards', [HomeController::class, 'showFlashcardMain'])->name('flashcards.main');
Route::get('/home/{hashed_user_id}/flashcards/{flashcard?}', [FlashcardController::class, 'showFlashcards'])->name('flashcards.show');
Route::get('/home/{hashed_user_id}/flashcards/level/{levelName}', [LevelController::class, 'indexByLevel'])->name('user.flashcards.level');
Route::post('/home/{hashed_user_id}/flashcards/{flashcard}/check', [LevelController::class, 'checkAnswer'])->name('user.flashcards.check_answer');
Route::get('/home/{hashed_user_id}/flashcards/{flashcard}/result/{levelName}', [LevelController::class, 'showResult'])->name('user.flashcards.result');
Route::get('/home/{hashed_user_id}/flashcards/level/{levelName}/next/{flashcard_id}', [LevelController::class, 'nextFlashcard'])->name('user.flashcards.next');
//endRoute flashcards_quizz--------------------------------------------------------------------------

//Route listening for user---------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/home/{hashed_user_id}/listenings/choice', [StudentListeningController::class, 'showListeningMain'])->name('ListeningMain');
    Route::get('/home/{hashed_user_id}/listenings', [StudentListeningController::class, 'index'])->name('user.listenings.index');
    Route::get('/home/{hashed_user_id}/listenings/level/{levelName}', [StudentListeningController::class, 'indexByLevel'])->name('user.listenings.level');
    Route::get('/home/{hashed_user_id}/listenings/{listening}', [StudentListeningController::class, 'show'])->name('user.listenings.show');
});
//endRoute listening for user------------------------------------------------------------------------

//Route pdf for user---------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/home/{hashed_user_id}/pdfs', [PdfController::class, 'indexForUser'])->name('user.pdfs.index');
    Route::get('/home/{hashed_user_id}/pdfs/{pdf}', [PdfController::class, 'show'])->name('user.pdfs.show');
});
//endRoute pdf for user------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/home/{hashed_user_id}/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/home/{hashed_user_id}/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/home/{hashed_user_id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

