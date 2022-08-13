<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Users;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/inscription', function () {
    return view('inscription');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/utilisateurs', [HomeController::class, 'utilisateurs'] )->name('utilisateurs');
Route::get('/chambres', [HomeController::class, 'chambres'] )->name('chambres');
Route::get('/typechambres', [HomeController::class, 'typechambres'] )->name('typechambres');
Route::get('/clients', [HomeController::class, 'clients'] )->name('clients');
Route::get('/reservations', [HomeController::class, 'reservations'] )->name('reservations');
