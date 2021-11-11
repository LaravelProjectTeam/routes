<?php

use App\Http\Controllers\Admin\AdminFillingStationController;
use App\Http\Controllers\Admin\AdminTownController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TownController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\TypeController;

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

//Route::middleware(['auth'])->prefix('admin')->group(function () {

// admin panel, todo: protect with middleware
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('index');
    Route::get('/index', [AdministrationController::class, 'index'])->name('index');
    Route::resource('/towns', AdminTownController::class);
    Route::resource('/fuels', FuelController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/filling_stations', AdminFillingStationController::class);
});

Auth::routes();
