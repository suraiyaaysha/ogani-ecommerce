<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\ProfileController;

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

/*--------------------------------------------------------------------------
| Authentication Routes start
|--------------------------------------------------------------------------*/

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware(['auth','admin']);

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin-login');
Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin-login');

/*--------------------------------------------------------------------------
| Authentication Routes End
|--------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------
| Frontend Routes start
|--------------------------------------------------------------------------*/
// Route::get('/', function () {
//     return view('frontend.index');
// });


/*--------------------------------------------------------------------------
| Admin Routes start
|--------------------------------------------------------------------------*/
// Route::get('/admin/profile', function () {
//     return view('admin.profile.edit');
// });


Route::middleware(['auth','admin'])->group(function () {
    Route::get('admin/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('admin/profile/{user}',[ProfileController::class,'update'])->name('admin.profile');

    Route::post('admin/profile',[ProfileController::class,'updatePassword'])->name('admin.profile');

});
