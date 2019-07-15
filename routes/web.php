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
    Route::get('options/index', 'OptionsController@index')->name('options.index');
    Route::get('options/create', 'OptionsController@create')->name('options.create');
    Route::post('options/create', 'OptionsController@store')->name('options.store');
    Route::put('options/update', 'OptionsController@update')->name('options.update');
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
            Route::post('index', 'UsersController@indexSuperAdmin')->name('users.sa.index');
            Route::post('masschanges', 'UsersController@massChangesSuperAdmin')->name('users.sa.masschanges');
            Route::get('add', 'UsersController@createSuperAdmin')->name('users.sa.add');
            Route::post('add', 'UsersController@storeSuperAdmin')->name('api.users.sa.store');
            Route::get('{userid}', 'UsersController@showSuperAdmin')->name('users.sa.show');
            Route::get('edit/{userid}', 'UsersController@editSuperAdmin')->name('users.sa.edit');
            Route::put('edit/{userid}', 'UsersController@updateSuperAdmin')->name('api.users.sa.update');
            Route::post('destroy/{userid}', 'UsersController@destroySuperAdmin')->name('users.sa.destroy');
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
            Route::post('destroy/{userid}', 'UsersController@destroyAdministrative')->name('api.users.ad.destroy');
        });
        //Coordinators
        Route::prefix('coordinators')->group(function () {
            Route::view('/', 'layouts.users.co.index')->name('users.co.index');
            Route::post('/index', 'UsersController@indexCoordinator')->name('api.users.co.index');
            Route::post('masschanges', 'UsersController@massChangesCoordinator')->name('api.users.co.masschanges');
            Route::get('add', 'UsersController@createCoordinator')->name('users.co.add');
            Route::post('/', 'UsersController@storeCoordinator')->name('api.users.co.store');
            Route::get('{userid}', 'UsersController@showCoordinator')->name('users.co.show');
            Route::get('edit/{userid}', 'UsersController@editCoordinator')->name('users.co.edit');
            Route::put('edit/{userid}', 'UsersController@updateCoordinator')->name('api.users.co.update');
            Route::post('destroy/{userid}', 'UsersController@destroyCoordinator')->name('api.users.co.destroy');
        });
        //Teachers
        Route::prefix('teachers')->group(function () {
            Route::view('/', 'layouts.users.te.index')->name('users.te.index');
            Route::post('/index', 'UsersController@indexTeacher')->name('api.users.te.index');
            Route::post('masschanges', 'UsersController@massChangesTeacher')->name('api.users.te.masschanges');
            Route::get('add', 'UsersController@createTeacher')->name('users.te.add');
            Route::post('/', 'UsersController@storeTeacher')->name('api.users.te.store');
            Route::get('{userid}', 'UsersController@showTeacher')->name('users.te.show');
            Route::get('edit/{userid}', 'UsersController@editTeacher')->name('users.te.edit');
            Route::put('edit/{userid}', 'UsersController@updateTeacher')->name('api.users.te.update');
            Route::post('destroy/{userid}', 'UsersController@destroyTeacher')->name('api.users.te.destroy');
        });
    });
    //Areas
    Route::prefix('areas')->group(function () {
        Route::get('/all', 'AreasController@all')->name('areas.all');
    });
});
