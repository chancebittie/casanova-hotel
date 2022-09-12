<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfContoller;
use App\Http\Controllers\PDFController;
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
Route::get('/liste-reservations', [HomeController::class, 'listeReservations'] )->name('liste_reservations');
Route::get('/reservations', [HomeController::class, 'reservations'] )->name('reservations');
Route::get('/restaurant-bar', [HomeController::class, 'restaurant_bar'] )->name('restaurant-bar');
Route::get('/paiements', [HomeController::class, 'paiements'] )->name('paiements');
Route::get('/facture', [PdfContoller::class, 'facture'] )->name('facture');
Route::get('downloadPDF/{id}',[PDFController::class, 'downloadPDF'])->name("downloadPDF");
Route::get('downloadPdfRestau/{id}',[PDFController::class, 'downloadPdfRestau'])->name("downloadPdfRestau");
Route::get('pdf',[PDFController::class, 'pdf'])->name("pdf");
