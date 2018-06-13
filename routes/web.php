<?php

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

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('awaiting-verification', function (){
    Auth::logout();
    return view('register-done');
});

Route::get('verify/{token?}', function ($token=''){

    if(! $token){
        return 'token not found';
    }

    $user = \App\User::where('verify_token', $token)->get()->first();

    if(! $user){
        return 'User not found!';
    }

    if($user->verified){
        return 'The link is expired!';
    }

    $user->active = 1;
    $user->verified = 1;

    if($user->save()){
        // now assign guest role to this user
        $role = \App\Role::where('name', 'user')->get()->first();
        $user->roles()->attach($role->id);
    }

    return view('verify');
});
