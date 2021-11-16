<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFillingStationController;
use App\Http\Controllers\Admin\AdminTownController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminFuelController;
use App\Http\Controllers\AdminTypeController;

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/towns', [TownController::class, 'index'])->name('towns.index');
Route::get('/towns/{id}/show', [TownController::class, 'show'])->name('towns.show');

Route::resource('/routes', RouteController::class);
Route::post('/routes/search', [RouteController::class, 'search'])->name('routes.search');

Route::resource('/contacts', ContactController::class);

// admin panel, todo: protect with middleware
// Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
//     Route::get('admin.index', 'AdminDashboardController')->name('admin.view')});
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin.index', 'AdminDashboardController@adminView')->name('admin.view');
});
 Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::get('/index', [AdminDashboardController::class, 'index']);//->name('index');
    Route::resource('/towns', AdminTownController::class);//->name('admin.towns');
    Route::resource('/fuels', AdminFuelController::class);//->name('admin.fuels');
    Route::resource('/road_types', AdminTypeController::class); //->name('admin.road_types');
    Route::resource('/users', AdminUserController::class);//->name('users');
    Route::resource('/filling_stations', AdminFillingStationController::class);//->name('admin.filling_stations');
});

Auth::routes();
