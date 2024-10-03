<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LangController;
use App\Http\Controllers\Admin\MyTranslationController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Auth::routes(['register'=>false]);

Route::prefix(LaravelLocalization::setLocale().'/admin')->middleware(['auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'setLocale'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    Route::resource('blogs', BlogController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('langs', LangController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('contacts', ContactController::class);

    Route::resource('mytranslations', MyTranslationController::class);
});

Route::prefix(LaravelLocalization::setLocale().'/')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'setLocale'])->group(function () {
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
    Route::get('/contact', [FrontController::class, 'contact'])->name('contact');

    // Services routes
    Route::get('/services', [FrontController::class, 'services'])->name('services.index');
    Route::get('/services/{service}', [FrontController::class, 'showService'])->name('services.show');

    // Blog routes
    Route::get('/blog', [FrontController::class, 'blog'])->name('blog.index');
    Route::get('/blog/{blog}', [FrontController::class, 'showBlog'])->name('blog.show');

        // Product routes
    Route::get('/products', [FrontController::class, 'products'])->name('products.index');
    Route::get("/products/{category}", [FrontController::class, 'showCategory'])->name('products.show');
    Route::get('/product/{product}', [FrontController::class, 'showProduct'])->name('product.show');

    Route::get('/api/search', [SearchController::class, 'search']);
});