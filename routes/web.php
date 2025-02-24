<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () { return view('index');})->name('index');
Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
Route::get('/ledger', function () {return view('ledger'); })->name('ledger');
Route::get('/payment', function () { return view('payment'); })->name('payment');
Route::get('/expense', function () { return view('expense'); })->name('expense');
Route::get('/currency', function () { return view('currency'); })->name('currency');
Route::get('/audit', function () { return view('audit'); })->name('audit');
Route::get('/billing', function () { return view('billing'); })->name('billing');
Route::get('/reimburse', function () { return view('reimburse'); })->name('reimburse');
Route::get('/early', function () { return view('early'); })->name('early');
Route::get('/receivables', function () { return view('receivables'); })->name('receivables');
Route::get('/tax', function () { return view('tax'); })->name('tax');
Route::get('/collected', function () { return view('collected'); })->name('collected');
Route::get('/compliance',function() {return view('compliance');})->name('compliance');


Route::get('/auth/signup', function () {
    return view('auth.signup');
});
Route::get('/auth/signin', function(){
    return view('auth.signin');
});
Route::get('/auth/forgot', function(){
    return view('auth.forgot');
});

//AUTH
Route::get('auth.signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('auth.signin');
