<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ItenController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\BlockController;
use App\Http\Controllers\Pages\CompanyController;
use App\Http\Controllers\Pages\InvoiceController;
use App\Http\Controllers\Pages\PaymentController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ConsultantController;
use App\Http\Controllers\Pages\CertificationController;

Route::get('/',                 [LoginController::class, 'index'])->name('login');
Route::post('/auth',            [LoginController::class, 'auth'])->name('auth');
Route::post('/logout',          [LoginController::class, 'logout'])->name('logout');

Route::get('/home',             [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/user',             [UserController::class, 'index'])->name('user')->middleware('auth');
Route::get('/consultant',       [ConsultantController::class, 'index'])->name('consultant')->middleware('auth');
Route::get('/product',          [ProductController::class, 'index'])->name('product')->middleware('auth');
Route::get('/block',            [BlockController::class, 'index'])->name('block')->middleware('auth');
Route::get('/iten',             [ItenController::class, 'index'])->name('iten')->middleware('auth');
Route::get('/certification',    [CertificationController::class, 'index'])->name('certification')->middleware('auth');
Route::get('/payament',         [PaymentController::class, 'index'])->name('payament')->middleware('auth');
Route::get('/company',          [CompanyController::class, 'index'])->name('company')->middleware('auth');
Route::get('/invoice/{id}',     [InvoiceController::class, 'index'])->name('invoice')->middleware('auth');


