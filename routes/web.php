<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendProfileController;


// use App\Http\Controllers\Frontend\FrontendProductCategoryController;
use App\Http\Controllers\Frontend\FrontendProductController;

use App\Http\Controllers\Frontend\FrontendBlogController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\SocialMediaShareController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\StripeWebhookController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\NewsletterController;

use Illuminate\Http\Request;
use Stripe\Stripe;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

/*--------------------------------------------------------------------------
| Authentication Routes start
|--------------------------------------------------------------------------*/

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Admin routes
// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware(['auth','admin']);

// Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin-login');
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

Route::get('/',[FrontendProductController::class,'index'])->name('frontend.index');

Route::middleware('auth')->group(function () {
    Route::get('profile',[FrontendProfileController::class,'index'])->name('frontend.profile');
    Route::post('profile/{user}',[FrontendProfileController::class,'update'])->name('frontend.update');

    Route::post('profile',[FrontendProfileController::class,'updatePassword'])->name('frontend.change_password');
    Route::delete('profile',[FrontendProfileController::class,'destroy'])->name('frontend.profile.destroy');
});

// Blog Pages route
Route::get('/blog',[FrontendBlogController::class,'index'])->name('frontend.blog');
// Route::get('/blog',[FrontendBlogController::class,'getBlogCategories'])->name('frontend.blog');
// Blog tags
// Route::get('/blog',[FrontendBlogController::class,'getTags'])->name('frontend.blog');
Route::get('/blog/{blog_slug}',[FrontendBlogController::class,'blogDetails'])->name('frontend.blogDetails');
// Blog Categories
Route::get('/blog/category/{category_slug}', [FrontendBlogController::class, 'blogsByCategory'])->name('frontend.blogsByCategory');
// Blog tags
Route::get('/blog/tag/{slug}', [FrontendBlogController::class, 'blogsByTag'])->name('frontend.blogsByTag');

// Blog Comment
Route::post('comments/store', [CommentController::class, 'store'])->name('comments.store');

// Social Share route
Route::get('social-share', [SocialMediaShareController::class, 'index']);

// Shop|Products Pages route
Route::get('/shop',[FrontendProductController::class,'getAllProducts'])->name('frontend.shop');
Route::get('/category/{slug}',[FrontendProductController::class,'productsByCategory'])->name('frontend.productsByCategory');
Route::get('/product/{slug}',[FrontendProductController::class,'productDetails'])->name('frontend.productDetails');
// Route::get('/filter-by-color', [FrontendProductController::class,'filterByColor'])->name('filterByColor');

// Product add to cart, order, payment related routes
Route::middleware('auth')->group(function () {
    // cart routes
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

    // checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    // Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


    // Route::post('/stripePayment', [CheckoutController::class, 'stripePayment'])->name('checkout.stripePayment');
    Route::post('/checkout/cash-on-delivery', [CheckoutController::class, 'cashOnDeliveryPayment'])->name('checkout.cashOnDeliveryPayment');

    Route::post('/checkout/stripe', [CheckoutController::class, 'stripePayment'])->name('checkout.stripePayment');


    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    Route::post('/webhook', [CheckoutController::class, 'webhook'])->name('checkout.webhook');

    // Route::post('/webhook', [CheckoutController::class, 'webhook']);

    // Route::post('/webhook/stripe', [StripeWebhookController::class, 'handleWebhook']);

    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');

    // order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Wishlist routes
    Route::get('/wishlist/', [WishlistController::class, 'index'])->name('wishlist');

    // Add product to wishlist
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');

    // Remove product from wishlist
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Product Review route
    Route::post('/products/{id}/reviews', [FrontendProductController::class, 'submitReview'])->name('products.reviews.submit');

});

// Product search
Route::get('/search', [FrontendProductController::class, 'search'])->name('product.search');

// newsletter subscribe
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');



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
    Route::get('admin/profile',[ProfileController::class,'index'])->name('admin.index');
    Route::post('admin/profile/{user}',[ProfileController::class,'update'])->name('admin.update');

    Route::post('admin/profile',[ProfileController::class,'updatePassword'])->name('admin.change_password');

});
