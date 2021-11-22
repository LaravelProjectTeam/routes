<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TownController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\FuelController;



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
Route::resource('towns', TownController::class);
Route::resource('routes', RouteController::class);
Route::resource('contacts', ContactController::class);
Route::resource('fuels', FuelController::class);

//Route::middleware(['auth'])->prefix('admin')->group(function () {
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
//Route::resource('admins', AdministrationController::class);
});

Route::post('routes/search', [RouteController::class, 'search'])->name('routes.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
