<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
//use Illuminate\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/callback', function () {
    $userSocial =   Socialite::driver('google')->user();
    $users       =   User::where(['email' => $userSocial->getEmail()])->first();

    if($users){
        Auth::login($users);
        return redirect('/dashboard');
    }else{
        $user = User::create([
            'name'          => $userSocial->getName(),
            'email'         => $userSocial->getEmail(),
            'avatar'        => $userSocial->getAvatar(),
            'provider_id'   => $userSocial->getId(),
            'provider'      => 'google',
        ]);
        return redirect()->route('dashboard');
    }

//    return view('callback');
});


Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
})->name('login_google');

Route::get('/register/google', function () {
    return Socialite::driver('google')->redirect();
});


Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    // OAuth 2.0 providers...
    $token = $user->token;
    $refreshToken = $user->refreshToken;
    $expiresIn = $user->expiresIn;

    $user->getId();
    $user->getNickname();
    $user->getName();
    $user->getEmail();
    $user->getAvatar();


    // $user->token
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
