<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendProfileController;


use App\Http\Controllers\Frontend\FrontendProductCategoryController;
use App\Http\Controllers\Frontend\FrontendProductController;

use App\Http\Controllers\Frontend\FrontendBlogController;

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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

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

Route::middleware('auth')->group(function () {
    Route::get('profile',[FrontendProfileController::class,'index'])->name('frontend.profile');
    Route::post('profile/{user}',[FrontendProfileController::class,'update'])->name('frontend.profile');

    Route::post('profile',[FrontendProfileController::class,'updatePassword'])->name('frontend.change_password');
    Route::delete('profile',[FrontendProfileController::class,'destroy'])->name('frontend.profile.destroy');
});

Route::get('/',[FrontendProductController::class,'getProductCategories'])->name('frontend.index');
Route::get('/',[FrontendProductController::class,'featuredProduct'])->name('frontend.index');
Route::get('/',[FrontendProductController::class,'latestProducts'])->name('frontend.index');
Route::get('/',[FrontendProductController::class,'productsWithReviews'])->name('frontend.index');

Route::get('/',[FrontendBlogController::class,'latestBlog'])->name('frontend.index');

// Blog Pages route
Route::get('/blog',[FrontendBlogController::class,'index'])->name('frontend.blog');
Route::get('/blog',[FrontendBlogController::class,'getBlogCategories'])->name('frontend.blog');
// Blog tags
Route::get('/blog',[FrontendBlogController::class,'getTags'])->name('frontend.blog');
Route::get('/blog/{blog_slug}',[FrontendBlogController::class,'blogDetails'])->name('frontend.blogDetails');
// Blog Categories
Route::get('/blog/category/{category_slug}', [FrontendBlogController::class, 'blogsByCategory'])->name('frontend.blogsByCategory');
// Blog tags
Route::get('/blog/tag/{slug}', [FrontendBlogController::class, 'blogsByTag'])->name('frontend.blogsByTag');


// Contact Page Route
Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('frontend.contact');

/*--------------------------------------------------------------------------
| Admin Routes start
|--------------------------------------------------------------------------*/
// Route::get('/admin/profile', function () {
//     return view('admin.profile.edit');
// });


Route::middleware(['auth','admin'])->group(function () {
    Route::get('admin/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('admin/profile/{user}',[ProfileController::class,'update'])->name('admin.profile');

    Route::post('admin/profile',[ProfileController::class,'updatePassword'])->name('admin.change_password');

});
