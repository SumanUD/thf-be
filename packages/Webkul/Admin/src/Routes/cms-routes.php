<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\CMS\PageController;
use Webkul\Admin\Http\Controllers\BlogController;
use Webkul\Admin\Http\Controllers\RecipeController;

/**
 * CMS routes.
 */
Route::prefix('cms')->group(function () {
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('admin.cms.index');

        Route::get('create', 'create')->name('admin.cms.create');

        Route::post('create', 'store')->name('admin.cms.store');

        Route::get('edit/{id}', 'edit')->name('admin.cms.edit');

        Route::put('edit/{id}', 'update')->name('admin.cms.update');

        Route::delete('edit/{id}', 'delete')->name('admin.cms.delete');

        Route::post('mass-delete', 'massDelete')->name('admin.cms.mass_delete');
    });

    Route::controller(BlogController::class)->prefix('blogs')->group(function () {
        Route::get('/', 'index')->name('admin.cms.blogs.index');
        Route::get('create', 'create')->name('admin.cms.blogs.create');
        Route::post('create', 'store')->name('admin.cms.blogs.store');
        Route::get('edit/{id}', 'edit')->name('admin.cms.blogs.edit');
        Route::put('edit/{id}', 'update')->name('admin.cms.blogs.update');
        Route::delete('delete/{id}', 'destroy')->name('admin.cms.blogs.delete');
    });

    Route::controller(RecipeController::class)->prefix('recipes')->group(function () {
        Route::get('/', 'index')->name('admin.cms.recipes.index');
        Route::get('create', 'create')->name('admin.cms.recipes.create');
        Route::post('create', 'store')->name('admin.cms.recipes.store');
        Route::get('edit/{id}', 'edit')->name('admin.cms.recipes.edit');
        Route::put('edit/{id}', 'update')->name('admin.cms.recipes.update');
        Route::delete('delete/{id}', 'destroy')->name('admin.cms.recipes.delete');
    });
});
