<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|`
*/

Route::get('/', function () {return view('welcome');});

Route::middleware('auth')->group(function(){
Route::get('/posts', [PostController::class, 'index'])->name('post.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');

Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 

Route::get('/auth/callback', function () {    
    $githubUser = Socialite::driver('github')->stateless()->user();
 
    $user = User::where('email', $githubUser->email)->first();
 
    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
 
    Auth::login($user);
 
    return redirect('/posts');
});


//=============================


Route::get('/redirect', function () {
    return Socialite::driver('google')->redirect();

});
 

Route::get('/auth/callback/google', function () {    
    $user = Socialite::driver('google')->stateless()->user();
    $guser = User::where('google_id', $user->id)->first();

    if ($guser) {
        Auth::login($guser);
                return redirect('/posts');
    } else {
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'google_id'=> $user->id,
            'password' => encrypt('123456dummy')
        ]);
        Auth::login($newUser);
        return redirect('/posts');
    }
});