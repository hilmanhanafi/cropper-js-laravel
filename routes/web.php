<?php

use App\Http\Controllers\CropperController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropImageController;
use App\Http\Controllers\CroppController;
use App\Http\Controllers\UploadController;

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

Route::get('/', [FileController::class, 'index']);
Route::post('/image-resize', [FileController::class, 'imgResize'])->name('img-resize');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/cropper-js', function () {
    return view('cropper');
});
Route::post('/upload-images', [CropperController::class, 'uploadImages']);



Route::get('crop-image-upload', [CropImageController::class, 'index']);
Route::post('crop-image-upload', [CropImageController::class, 'uploadCropImage']);


Route::get('upload', [CroppController::class, 'index']);
Route::post('crop', [CroppController::class, 'crop'])->name('crop');

Route::get('/coba', [UploadController::class, 'index']);
Route::post('/uploads', [UploadController::class, 'uploads']);
