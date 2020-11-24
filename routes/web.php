<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/beranda', 'beranda_controller');
    Route::resource('admin/user', 'user_controller');
    Route::get('admin/json','user_controller@json');
    Route::patch('admin/user/update/{id}', 'user_controller@update');
    Route::get('admin/profile','Profile_controller@index')->name('view.profile');
    Route::patch('admin/profile/update', 'Profile_controller@update');
    Route::post('admin/profile/sore', 'Profile_controller@store')->name('profile.store');

    // Route::patch('admin/user/update/{id}', 'user_controller@update');
    // Route::get('admin/user/delete/{id}', 'user_controller@destroy');
    // Route::resource('admin/profile', 'profile_controller');
    // Route::patch('admin/profile/update', 'user_controller@update');
});

Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
        return redirect('/');
    });

Route::get('/home', function () {
    return redirect('admin/beranda');
});