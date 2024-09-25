<?php

use Illuminate\Support\Facades\Route;
use NguyenKhoi\FileManager\Http\Controllers\FileController;
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
            Route::delete('remove-trash', 'removeTrash')->name('destroy');
        });
        Route::controller(FolderController::class)->group(function () {
            Route::post('create-folder', 'saveFolder')->name('folder.create');
        });
        Route::controller(FileController::class)->group(function () {
            Route::post('upload-from-url', 'uploadFileUrl')->name('file.uploadMultiple');
            Route::post('upload-file', 'uploadFile')->name('file.uploadFile');
        });
    });
});
