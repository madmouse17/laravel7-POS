<?php

use Illuminate\Support\Facades\Route;
use App\setting;
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
    $setting = setting::where('id', 1)->first();
    return view('auth.login', compact('setting'));
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('admin/beranda', 'beranda_controller');

    // Manage User
    Route::resource('admin/user', 'user_controller');
    Route::get('admin/json', 'user_controller@json');
    Route::patch('admin/user/update/{id}', 'user_controller@update');

    // View Profile
    Route::get('admin/profile', 'Profile_controller@index')->name('view.profile');
    Route::patch('admin/profile/update', 'Profile_controller@update');
    Route::post('admin/profile/store', 'Profile_controller@store')->name('profile.store');

    // Setting
    Route::resource('admin/setting', 'setting_controller');
    Route::patch('admin/detail', 'setting_controller@store')->name('setting.detail');
    Route::patch('admin/icon', 'setting_controller@icon')->name('setting.icon');
    Route::patch('admin/logo', 'setting_controller@logo')->name('setting.logo');

    // Log-activity
    Route::resource('admin/log-activity', 'LogController');
    Route::get('admin/log_json', 'LogController@log_json');

    // Manage Categories
    Route::resource('admin/categories', 'categories_controller');
    Route::get('admin/category_json', 'categories_controller@category_json');
    Route::patch('admin/categories/update/{id}', 'categories_controller@update');

    //Manage Supplier
    Route::resource('admin/supplier', 'supplier_controller');
    Route::get('admin/supplier_json', 'supplier_controller@supplier_json');
    Route::patch('admin/supplier/update/{id}', 'supplier_controller@update');


    //Manage Product
    Route::get('admin/product/search', 'product_controller@search')->name('product.search');
    Route::resource('admin/product', 'product_controller');
    Route::get('admin/product_json', 'product_controller@product_json');
    Route::patch('admin/product/update/{id}', 'product_controller@update');

    // ManageTransaksi
    Route::resource('admin/transaksi', 'TransaksiController');
    Route::get('admin/lihatproduct_json', 'TransaksiController@product_json');
    Route::post('admin/transaksi/addProduct/', 'TransaksiController@addProductCart')->name('add.product');
    Route::post('admin/transaksi/removeProduct/{id}', 'TransaksiController@removeProductCart')->name('remove.product');

    // My Transaksi routes
    Route::name('my-transaksi')->group(function () {
        Route::get('/admin/my-transaksi', 'MyTransaksiController@index');
        Route::post('/admin/my-transaksi', 'MyTransaksiController@submit')->name('.submit');
        Route::get('/admin/report', 'MyTransaksiController@report')->name('.report');
        Route::get('/admin/download', 'MyTransaksiController@create')->name('.download');
    });

    // Role & permission
        Route::resource('/admin/role', 'RoleController');
        Route::get('admin/role_json', 'RoleController@role_json');
        Route::patch('admin/role/update/{id}', 'RoleController@update');
        Route::get('admin/role/delete/{id}', 'RoleController@destroy');;
});

Auth::routes(['register'=> false, 'reset'=>false]);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/home', function () {
    return redirect('admin/beranda');
});