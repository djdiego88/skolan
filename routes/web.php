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
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Agrupa todas las rutas a usuarios autenticados y habilitados
Route::middleware(['auth', 'enabled'])->group(function () {
    //Home
    Route::get('/', function () {
        return view('dashboard');
    });
    //Options
    Route::view('options', 'layouts.options.index')->name('options');
    Route::get('api/options/index', 'OptionsController@index')->name('options.index');
    Route::get('options/create', 'OptionsController@create')->name('options.create');
    Route::post('api/options/create', 'OptionsController@store')->name('options.store');
    Route::put('api/options/update', 'OptionsController@update')->name('options.update');
    //Roles
    Route::prefix('roles')->group(function () {
        Route::get('/all', 'RoleController@all')->name('roles.all');
    });
    //Users
    Route::prefix('users')->group(function () {
        Route::get('/', 'UsersController@index')->name('users.index');
        //Superadmins
        Route::prefix('superadmins')->group(function () {
            Route::view('/', 'layouts.users.sa.index')->name('users.sa');
            Route::post('api/index', 'UsersController@indexSuperAdmin')->name('users.sa.index');
            Route::post('api/masschanges', 'UsersController@massChangesSuperAdmin')->name('users.sa.masschanges');
            Route::get('add', 'UsersController@createSuperAdmin')->name('users.sa.add');
            Route::post('add', 'UsersController@storeSuperAdmin')->name('api.users.sa.store');
            Route::get('{userid}', 'UsersController@showSuperAdmin')->name('users.sa.show');
            Route::get('edit/{userid}', 'UsersController@editSuperAdmin')->name('users.sa.edit');
            Route::put('edit/{userid}', 'UsersController@updateSuperAdmin')->name('api.users.sa.update');
            Route::post('api/destroy/{userid}', 'UsersController@destroySuperAdmin')->name('users.sa.destroy');
        });
        //Administratives
        Route::prefix('admins')->group(function () {
            Route::view('/', 'layouts.users.ad.index')->name('users.ad.index');
            Route::post('/index', 'UsersController@indexAdministrative')->name('api.users.ad.index');
            Route::post('masschanges', 'UsersController@massChangesAdministrative')->name('api.users.ad.masschanges');
            Route::get('add', 'UsersController@createAdministrative')->name('users.ad.add');
            Route::post('/', 'UsersController@storeAdministrative')->name('api.users.ad.store');
            Route::get('{userid}', 'UsersController@showAdministrative')->name('users.ad.show');
            Route::get('edit/{userid}', 'UsersController@editAdministrative')->name('users.ad.edit');
            Route::put('edit/{userid}', 'UsersController@updateAdministrative')->name('api.users.ad.update');
            Route::get('destroy/{userid}', 'UsersController@destroyAdministrative')->name('api.users.ad.destroy');
        });
    });
});
