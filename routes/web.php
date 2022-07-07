<?php

// use VehicleController;

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\BillingController;
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

    Route::resource('Module', "ModuleController");
    Route::resource('DesignationModule', "DesignationModuleController");
    Route::resource('Designation', "DesignationController");
    Route::any('layout-set', 'LayoutController@setting_menu')->name('layout-set');
    Route::any('layout-set-auth', 'LayoutController@setting_auth')->name('layout-set-auth');
    Route::get('/home', 'HomeController@index')->name('home');

});
