<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\BlockController;
use App\Http\Controllers\Pages\PaymentController;
use App\Http\Controllers\Pages\ConsultantController;
use App\Http\Controllers\Pages\CertificationController;

Route::get('/',                 [HomeController::class, 'index'])->name('home');
Route::get('/user',            [UserController::class, 'index'])->name('user');
Route::get('/consultant',       [ConsultantController::class, 'index'])->name('consultant');
Route::get('/block',            [BlockController::class, 'index'])->name('block');
Route::get('/iten',             [BlockController::class, 'index'])->name('iten');
Route::get('/certification',    [CertificationController::class, 'index'])->name('certification');
Route::get('/payament',         [PaymentController::class, 'index'])->name('payament');
