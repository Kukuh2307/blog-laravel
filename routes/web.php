<?php

use App\Http\Controllers\authController;
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
Route::get('/', function () {
    return view('blog.index');
});

// route ke halaman login
Route::get('/login', [authController::class, 'index']);

// route authentikasi login
Route::post('/login', [authController::class, 'authenticate']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');
