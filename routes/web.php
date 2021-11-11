<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFillingStationController;
use App\Http\Controllers\Admin\AdminTownController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\TypeController;

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
//Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::get('/index', [AdminDashboardController::class, 'index'])->name('index');
    Route::resource('/towns', AdminTownController::class);
    Route::resource('/fuels', FuelController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/filling_stations', AdminFillingStationController::class);
});

Auth::routes();
