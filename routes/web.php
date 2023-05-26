<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// })

Route::get('/', function () {
    return view('frontend.index');
});

/*|--------------------------------------------------------------------------
| Authentication Routes start
|--------------------------------------------------------------------------*/

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware(['auth','admin']);

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin-login');
Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin-login');

/*|--------------------------------------------------------------------------
| Authentication Routes End
|--------------------------------------------------------------------------*/

/*|--------------------------------------------------------------------------
| Frontend Routes start
|--------------------------------------------------------------------------*/
// Route::get('/', function () {
//     return view('frontend.index');
// });
/*|--------------------------------------------------------------------------
| Frontend Routes end
|--------------------------------------------------------------------------*/
