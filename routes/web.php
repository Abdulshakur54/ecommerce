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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::match(['get','post'],'change_password','AdminController@changePassword');
        Route::match(['get','post'],'update_profile','AdminController@updateProfile');
        Route::post('confirm_admin_password', 'AdminController@confirmAdminPassword');
        Route::get('admins/{slug}','AdminController@admins');
        Route::get('view_vendor_details/{vendorId?}','AdminController@viewVendorDetails');
        Route::post('update_admin_status','AdminController@updateAdminStatus');
    });
    Route::match(['get','post'],'login', 'AdminController@login');
    Route::match(['get','post'],'update_vendor_details/{slug}', 'AdminController@updateVendorDetails');
    
});

Route::get('/phpinfo', function() {
    return phpinfo();
});
