<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFillingStationController;
use App\Http\Controllers\Admin\AdminFuelController;
use App\Http\Controllers\Admin\AdminRouteController;
use App\Http\Controllers\Admin\AdminTownController;

use App\Http\Controllers\Admin\AdminTypeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TownController;

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
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts/create', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/towns', [TownController::class, 'index'])->name('towns.index');
Route::get('/towns/{id}/show', [TownController::class, 'show'])->name('towns.show');

Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
Route::get('/routes/{id}/show', [RouteController::class, 'show'])->name('routes.show');
Route::post('/routes/search', [RouteController::class, 'search'])->name('routes.search');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::get('/index', [AdminDashboardController::class, 'index']);
    Route::resource('/towns', AdminTownController::class);
    Route::resource('/fuels', AdminFuelController::class);
    Route::resource('/road_types', AdminTypeController::class);
    Route::resource('/routes', AdminRouteController::class);
    Route::resource('/filling_stations', AdminFillingStationController::class);
    Route::resource('/users', AdminUserController::class);
});

Auth::routes();
