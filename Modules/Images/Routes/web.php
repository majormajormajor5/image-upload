<?php

use \Modules\Images\InterfaceAdapters\Http\Controllers\ImagesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('images')->group(function() {
    Route::get('/', [ImagesController::class, 'index']);
    Route::get('/get-all-uploaded-images', [ImagesController::class, 'getAllUploadedImages']);
    Route::post('/', [ImagesController::class, 'store'])->name('images.upload');
});
