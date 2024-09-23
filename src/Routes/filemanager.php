<?php

use Illuminate\Support\Facades\Route;
use Nguyenkhoi\FileManager\Controllers\MediaFileController;


Route::group(['prefix' => 'file-manager', 'as' => 'media.'], function () {
    Route::controller(MediaFileController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});
