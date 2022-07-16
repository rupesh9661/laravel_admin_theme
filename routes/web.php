<?php

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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




// original routing starts from here
Route::any('/', function () {
    return redirect('login');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'module_assign']], function () {
    Route::any('layout-set', 'LayoutController@setting_menu')->name('layout-set');
    Route::any('layout-set-auth', 'LayoutController@setting_auth')->name('layout-set-auth');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('Module', "ModuleController");
    Route::resource('DesignationModule', "DesignationModuleController");
    Route::get('get_child_modules', 'DesignationModuleController@getChildModules');
    Route::get('get_module_prev_access', 'DesignationModuleController@getModulePrevAccess');
    Route::resource('Designation', "DesignationController");
    Route::get('DesingnationRouteMaster', 'DesingnationRouteMasterController@RouteMaster')->name('RouteMaster');
    Route::get('GetUserId/{id}', 'DesingnationRouteMasterController@RouteMasterAjax');
    Route::get('GetModuleId/{user_id}', 'DesingnationRouteMasterController@ModuleUserAssigning');
    Route::get('getUsers/{module_id}', 'DesingnationRouteMasterController@getUsers');
    Route::post('DesignationStore', 'DesingnationRouteMasterController@store');
    Route::resource('master_routes_url', "master_routes_urlController");
    Route::get('BlockUsers' , 'UserController@BlockUsers');
    Route::get('Notifications/create', 'NotificationController@create');
    Route::post('Notifications/store', 'NotificationController@store');
    Route::get('notifications/{type}', 'NotificationController@notificationManager');
    // dummy route
    Route::get('nothing' , 'UserController@BlockUsers');

});
