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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes start
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware(['auth','admin']);

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin-login');
Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin-login');

// Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
// Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

// Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
// Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/admin/dashboard',function(){
//     return view('admin');
// })->middleware('auth:admin');
/*
|--------------------------------------------------------------------------
| Authentication Routes start
|--------------------------------------------------------------------------
*/
