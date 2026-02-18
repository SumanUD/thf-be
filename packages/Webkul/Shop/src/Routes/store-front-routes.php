<?php

use Illuminate\Support\Facades\Route;
use Webkul\Shop\Http\Controllers\BookingProductController;
use Webkul\Shop\Http\Controllers\CompareController;
use Webkul\Shop\Http\Controllers\HomeController;
use Webkul\Shop\Http\Controllers\PageController;
use Webkul\Shop\Http\Controllers\ProductController;
use Webkul\Shop\Http\Controllers\ProductsCategoriesProxyController;
use Webkul\Shop\Http\Controllers\SearchController;
use Webkul\Shop\Http\Controllers\SubscriptionController;

/**
 * CMS pages.
 */
Route::get('page/{slug}', [PageController::class, 'view'])
    ->name('shop.cms.page')
    ->middleware('cache.response');

/**
 * Fallback route.
 */
Route::fallback(ProductsCategoriesProxyController::class.'@index')
    ->name('shop.product_or_category.index')
    ->middleware('cache.response');

/**
 * Store front home.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('shop.home.index')
    ->middleware('cache.response');

Route::get('contact-us', [HomeController::class, 'contactUs'])
    ->name('shop.home.contact_us')
    ->middleware('cache.response');

Route::post('contact-us/send-mail', [HomeController::class, 'sendContactUsMail'])
    ->name('shop.home.contact_us.send_mail')
    ->middleware('cache.response');

/**
 * Store locator page.
 */
Route::get('store-locator', [HomeController::class, 'storeLocator'])
    ->name('shop.store-locator.index')
    ->middleware('cache.response');

/**
 * FAQ page.
 */
Route::get('faq', [HomeController::class, 'faq'])
    ->name('shop.faq.faq-index')
    ->middleware('cache.response');

/**
 * Contact page.
 */
Route::get('contact', [HomeController::class, 'contact'])
    ->name('shop.contact.contact-index')
    ->middleware('cache.response');

/**
 * Career page.
 */
Route::get('career', [HomeController::class, 'career'])
    ->name('shop.career.career-index')
    ->middleware('cache.response');

/**
 * Blogs page.
 */
Route::get('blogs', [HomeController::class, 'blogs'])
    ->name('shop.insights.blogs')
    ->middleware('cache.response');

Route::get('blogs/{slug}', [HomeController::class, 'blogView'])
    ->name('shop.insights.blog_view')
    ->middleware('cache.response');

/**
 * Recepie page.
 */
Route::get('recepie', [HomeController::class, 'recepie'])
    ->name('shop.insights.recepie')
    ->middleware('cache.response');

Route::get('recepie/{slug}', [HomeController::class, 'recipeView'])
    ->name('shop.insights.recipe_view')
    ->middleware('cache.response');


/**
 * Corporate gifting page.
 */
Route::get('corporate', [HomeController::class, 'corporate'])
    ->name('shop.corporate.index')
    ->middleware('cache.response');

/**
 * Collection/Category page.
 */
Route::get('collection', [HomeController::class, 'collection'])
    ->name('shop.collection.index')
    ->middleware('cache.response');

/**
 * Category pages.
 */
Route::get('baklava', [HomeController::class, 'baklava'])
    ->name('shop.baklava.index')
    ->middleware('cache.response');

Route::get('labon', [HomeController::class, 'labon'])
    ->name('shop.labon.index')
    ->middleware('cache.response');

Route::get('dates', [HomeController::class, 'dates'])
    ->name('shop.dates.index')
    ->middleware('cache.response');

Route::get('mewabite', [HomeController::class, 'mewabite'])
    ->name('shop.mewabite.index')
    ->middleware('cache.response');

Route::get('assorted-collection', [HomeController::class, 'assorted'])
    ->name('shop.assorted.index')
    ->middleware('cache.response');

/**
 * Additional pages.
 */
Route::get('specialty-coffee', [HomeController::class, 'specialtyCoffee'])
    ->name('shop.specialty-coffee.index')
    ->middleware('cache.response');

Route::get('healthy-food', [HomeController::class, 'healthyFood'])
    ->name('shop.healthy-food.index')
    ->middleware('cache.response');

Route::get('brand-story', [HomeController::class, 'brandStory'])
    ->name('shop.brand-story.index')
    ->middleware('cache.response');

/**
 * Store front search.
 */
Route::get('search', [SearchController::class, 'index'])
    ->name('shop.search.index')
    ->middleware('cache.response');

Route::post('search/upload', [SearchController::class, 'upload'])->name('shop.search.upload');

/**
 * Subscription routes.
 */
Route::controller(SubscriptionController::class)->group(function () {
    Route::post('subscription', 'store')->name('shop.subscription.store');

    Route::get('subscription/{token}', 'destroy')->name('shop.subscription.destroy');
});

/**
 * Compare products
 */
Route::get('compare', [CompareController::class, 'index'])
    ->name('shop.compare.index')
    ->middleware('cache.response');

/**
 * Downloadable products
 */
Route::controller(ProductController::class)->group(function () {
    Route::get('downloadable/download-sample/{type}/{id}', 'downloadSample')->name('shop.downloadable.download_sample');

    Route::get('product/{id}/{attribute_id}', 'download')->name('shop.product.file.download');
});

/**
 * Booking products
 */
Route::get('booking-slots/{id}', [BookingProductController::class, 'index'])
    ->name('shop.booking-product.slots.index');
