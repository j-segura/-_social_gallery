<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/home', [PictureController::class, 'index'])->name('home');
});


Route::get('/image/create', [PictureController::class, 'create'])->name('image.create');
Route::post('/image/store', [PictureController::class, 'store'])->name('image.store');
Route::delete('/image/destroy/{picture}', [PictureController::class, 'destroy'])->name('image.destroy');

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
