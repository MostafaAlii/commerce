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
        });
});