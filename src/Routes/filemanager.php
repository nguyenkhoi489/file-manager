<?php

use Illuminate\Support\Facades\Route;
use NguyenKhoi\FileManager\Http\Controllers\FolderController;
use NguyenKhoi\FileManager\Http\Controllers\MediaController;


Route::group(
    [
        'middleware' => ['web', 'auth']
    ], function () {
    Route::group([
        'prefix' => 'file-manager',
        'as' => 'media.',
    ], function () {
        Route::controller(MediaController::class)->group(function () {
            Route::get('/',  'index')->name('file-manager');
            Route::get('load-media', 'loadMedia')->name('loadMedia');
            Route::post('update-options', 'updateName')->name('update');

        });
        Route::controller(FolderController::class)->group(function () {
            Route::post('create-folder', 'saveFolder')->name('folder.create');
        });
    });
});
