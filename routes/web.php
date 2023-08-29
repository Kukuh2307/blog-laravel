<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CateagoryController;
use App\Http\Controllers\slideController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route ke halaman index
Route::get('/', [BlogController::class, 'index']);

// route ke halaman login
Route::get('/login', [authController::class, 'index']);

// route authentikasi login
Route::post('/login', [authController::class, 'authenticate']);

// mencegah user mengakses halaman dashboard tanpa login
Route::get('/login', [authController::class, 'index'])->name('login')->middleware('guest');

// apabila user sudah masuk dasboard namun ingin mengakses halaman login akan di handle
Route::redirect('home', 'dashboard');

// route logout admin
Route::post('/logout', [authController::class, 'logout']);

// route halaman dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index')->with(['tittle' => 'About']);
})->middleware('auth');

// route halaman slide
Route::resource('/dashboard/slide', slideController::class)->middleware('auth');

// route kategori dashboard
Route::resource('/dashboard/kategori', CateagoryController::class)->middleware('auth');

// route slug
Route::get('/slug-kategori', [CateagoryController::class, 'getSlug'])->middleware('auth');
