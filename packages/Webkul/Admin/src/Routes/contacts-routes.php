<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\ContactSubmissionController;

Route::group(['prefix' => 'contacts'], function () {
    Route::get('', [ContactSubmissionController::class, 'index'])->name('admin.contacts.index');

    Route::get('view/{id}', [ContactSubmissionController::class, 'view'])->name('admin.contacts.view');

    Route::delete('delete/{id}', [ContactSubmissionController::class, 'destroy'])->name('admin.contacts.delete');
});
