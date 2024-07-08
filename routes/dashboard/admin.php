<?php

use App\Http\Controllers\Dashboard\Admin;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'admin'/*, 'middleware' => 'auth:admin'*/], function () {
                Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
                Route::resource('category', Admin\CategoryController::class);
                Route::resource('brands', Admin\BrandsController::class);
                Route::resource('sliders', Admin\SliderController::class);
                Route::resource('banners', Admin\BannerController::class);
                Route::resource('coupons', Admin\CouponController::class);
        });
});