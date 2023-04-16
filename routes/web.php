<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController as CommonAboutController;
use App\Http\Controllers\BlogController as CommonBlogController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    // Action Bar Admin Ajax Router 
    Route::post('/show-listing-with-action-bar', [Controller::class, 'displayListing'])->name('showWithActionBar');
    //Dashboard Router
    Route::get('/dashboard', [DashBoardController::class, 'list'])->name('dashboard');
    Route::post('/dashboard/filter-by-day-statistic-earnings-with-ajax', [DashBoardController::class, 'statisticEarningsFilterByDate'])->name('statistic-earnings');
    Route::post('/filter/filter-with-option', [DashBoardController::class, 'statisticEarningsFilterByOption'])->name('filter-by-option');
    Route::post('/dashboard/filter-default-statistic-30-days', [DashBoardController::class, 'defaultStatistic30Days']);
    //Profile Router 
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

    //Role Router
    Route::resource('/role', RoleController::class)->names('role');

    //Tag Router
    Route::resource('/tag', TagController::class)->names('tag')->except('show');

    //Blog Router
    Route::resource('/blog', BlogController::class)->names('blog');

    //Color Router
    Route::get('/color', [ColorController::class, 'index'])->name('color.index');
    Route::get('/color/create', [ColorController::class, 'create'])->name('color.create');
    Route::post('/color', [ColorController::class, 'store'])->name('color.store');
    Route::get('/color/{id}/edit', [ColorController::class, 'edit'])->name('color.edit');
    Route::put('/color/{id}', [ColorController::class, 'update'])->name('color.update');
    Route::delete('/color/{id}', [ColorController::class, 'delete'])->name('color.destroy');

    //Size router
    Route::get('/size', [SizeController::class, 'index'])->name('size.index');
    Route::get('/size/create', [SizeController::class, 'create'])->name('size.create');
    Route::post('/size', [SizeController::class, 'store'])->name('size.store');
    Route::get('/size/{id}/edit', [SizeController::class, 'edit'])->name('size.edit');
    Route::put('/size/{id}', [SizeController::class, 'update'])->name('size.update');
    Route::delete('/size/{id}', [SizeController::class, 'delete'])->name('size.destroy');

    //Contact Router 
    Route::resource('/contact', ContactController::class)->except('show')->names('contact');

    //About Router 
    Route::resource('/about', AboutController::class)->except('show')->names('about');

    //Banner Router
    Route::resource('/banner', BannerController::class)->names('banner')->except('show');

    //Slider Router 
    Route::resource('/slider', SliderController::class)->except('show')->names('slider');

    //Menu Router 
    Route::resource('/menu', MenuController::class)->except('show')->names('menu');

    //Category Router 
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'showChangeView'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.destroy');

    //User Router
    Route::resource('/manage-user', UserController::class)->except('show')->names('manage_user');

    //Permission Router
    // Route::resource('/permission', PermissionController::class)->names('permission');

    //Product Router
    Route::resource('/product', ProductController::class)->names('product');
    //Product Color Size Quanlities Router 
    Route::post('/product/quanlities-manager', [ProductController::class, 'manageQuanlities'])->name('products.manage_product-quanlities');
    //Coupon Router 
    Route::resource('/coupon', CouponController::class)->except('show')->names('coupon');
    //Payment Router 
    Route::resource('/payment', PaymentController::class)->except('show')->names('payment');
    //Order Router
    Route::get('/order/order-check', [AdminOrderController::class, 'orderCheck'])->name('admin.order-check');
    Route::get('/order/order-show-detail/{order}', [AdminOrderController::class, 'orderShow'])->name('admin.order-show');
    Route::post('/order/confirm-order/{order}', [AdminOrderController::class, 'orderConfirm'])->name('admin.order-confirm');
    Route::post('/order/delete-order/{order}', [AdminOrderController::class, 'orderDelete'])->name('admin.order-delete');
    
    // //Discount Router
    // Route::resource('/discount', DiscountController::class)->names('discount');
    // Route::put('/discount/update-status/{id}', [DiscountController::class,'changeStatus'])->name('discount.changeStatus');
    
    //Notification
    Route::get('/notifications', [NotificationController::class, 'getListNotification'])->name('admin.getListNotification');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markNotification'])->name('admin.markNotification');
});
Route::get('/admin/login',[LoginController::class,'adminLoginForm'])->name('admin.login');
Auth::routes();
Route::get('/social/fabebook', [SocialLoginController::class, 'redirectToFacebook'])->name('redirect-facebook');
Route::get('/facebook/callback', [SocialLoginController::class, 'processLoginWithFacebook']);
Route::group(['prefix' => '/user', 'middleware' => ['auth','lock-account']], function () {
   
    // route------------payment
    Route::get('/cofirm-payment', [UserCartController::class, 'confirmPayment'])->name('payment.confirm');
    // route------------order
    Route::get('/view-cart', [UserCartController::class, 'listProductInCart'])->name('view-cart');
    Route::get('/order/track-order', [UserOrderController::class, 'trackOrder'])->name('order.track-user');
    Route::post('/order/order-tracked-with-ajax', [UserOrderController::class, 'processTrackedOrder']);
    // User---------------coupon
    Route::post('/check-coupon', [CouponController::class, 'check_coupon'])->name('checkCoupon');
    // client------------Payment 
    Route::post('/payment/apply-coupon-code', [UserCartController::class, 'applyCouponCodeWithAjax'])->name('payment.applyCouponAjax');
    Route::post('/payment/proceed-to-order', [UserCartController::class, 'proceedToOrder'])->name('payment.acceptedOrder');
    Route::post('/payment/cancel-order', [UserCartController::class, 'cancelOrder'])->name('payment.cancelOrder');
    Route::get('/thank-to-order', [UserCartController::class, 'thankForOrdering'])->name('thankToOrder');

    Route::get('/my-profile',[UserProfileController::class,'getPrivateInfo'])->name('user.my-profile');
    Route::put('/my-profile/{profile}', [UserProfileController::class, 'update'])->name('user.profile.update');

});
 //user--------------cart
 Route::post('/user/save-to-cart', [UserCartController::class, 'store'])->name('save-cart');
 Route::delete('/user/delete-form-cart/{id}', [UserCartController::class, 'deleteFromCart'])->name('cart.delete');
 Route::put('/user/update-cart/{id}', [UserCartController::class, 'updateCart'])->name('cart.update');
 Route::get('/user/list-product-in-cart', [UserCartController::class, 'listProductInCart'])->name('cart-user');
//home router 
Route::get('/home', [HomeController::class, 'index'])->name('home-user');

// client& user contact router 
Route::get('/contact', [ClientContactController::class, 'index'])->name('contact-user');
Route::post('/contact/send-mail', [ClientContactController::class, 'sendMailContact'])->name('mail-contact')->middleware('auth');

//client & user about router 
Route::get('/view-about', [CommonAboutController::class, 'index'])->name('about-user');

//client & user blog router 
Route::get('/view-list-blog', [CommonBlogController::class, 'listBlogs'])->name('blog-user');
Route::get('/view-list-blog/fetch-data', [CommonBlogController::class, 'fetchData'])->name('blog-fetch_data');
Route::get('/view-list-blog/detail-blog/{id}', [CommonBlogController::class, 'detailBlog'])->name('detail-blog');
Route::get('/view-list-blog-with-tag/tag-id={id}', [CommonBlogController::class, 'viewListBlogByTag'])->name('selectBlogByTag');
Route::get('/view-list-blog-with-archive/archive-time={time}', [CommonBlogController::class, 'viewListBlogByArchive'])->name('selectBlogByArchive');
Route::post('/insert-blog-coment-with-ajax', [CommonBlogController::class, 'commentForBlog'])->middleware('ajax.isLogined');
Route::post('/loadComment-blog-with-ajax', [CommonBlogController::class, 'loadCommentBlog']);

//client--------------product
Route::get('/product/view-product-list', [ClientProductController::class, 'listProduct'])->name('shop-user');
Route::get('/product/product-detail/{product}', [ClientProductController::class, 'showDetail'])->name('shop.show');
Route::get('/product/category-product/category={name}', [ClientProductController::class, 'showProductByCategory'])->name('user.shop.showByCategory');
Route::post('/product/load-more-with-ajax', [ClientProductController::class, 'loadMoreProduct'])->name('loadMore.product');
Route::post('/home/qick-view-ajax', [HomeController::class, 'qickViewSpecifiedProduct'])->name('qickView.home');
Route::post('/filter-product-with-ajax', [ClientProductController::class, 'showProductByFilter'])->name('filter-product');
Route::post('/product/filter-load-more-with-ajax', [ClientProductController::class, 'loadMoreWhenFilter'])->name('filter-product.loadMore');
Route::post('/search-product', [ClientProductController::class, 'searchingProduct'])->name('searchingProduct');
Route::post('/product/rating-product/{product}', [ClientProductController::class, 'ratingProduct'])->middleware('ajax.isLogined');
Route::post('/loadComment-rating-product-with-ajax', [ClientProductController::class, 'loadMoreRatingProduct']);

