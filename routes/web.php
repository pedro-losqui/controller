<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ItenController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\BlockController;
use App\Http\Controllers\Pages\InvoiceController;
use App\Http\Controllers\Pages\PaymentController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ConsultantController;
use App\Http\Controllers\Pages\CertificationController;

Route::get('/',                 [HomeController::class, 'index'])->name('home');
Route::get('/user',             [UserController::class, 'index'])->name('user');
Route::get('/consultant',       [ConsultantController::class, 'index'])->name('consultant');
Route::get('/product',          [ProductController::class, 'index'])->name('product');
Route::get('/block',            [BlockController::class, 'index'])->name('block');
Route::get('/iten',             [ItenController::class, 'index'])->name('iten');
Route::get('/certification',    [CertificationController::class, 'index'])->name('certification');
Route::get('/payament',         [PaymentController::class, 'index'])->name('payament');
Route::get('/invoice/{id}',     [InvoiceController::class, 'index'])->name('invoice');
