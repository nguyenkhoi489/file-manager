<?php

use Illuminate\Support\Facades\Route;
use NguyenKhoi\FileManager\Http\Controllers\MediaController;


Route::group(
    [
        'namespace' => 'NguyenKhoi\FileManager\Http\Controllers',
        'middleware' => ['web']
    ], function () {
    Route::group([
        'prefix' => 'file-manager',
        'as' => 'media.',
    ], function () {
        Route::get('/', 'MediaController@index')->name('file-manager');
        Route::get('load-media', 'MediaController@loadMedia')->name('loadMedia');
    });
});
