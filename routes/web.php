<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['domain' => config('wink.domain')], function () {
    Route::get('/', function () {
        return redirect()->route('wink.auth.login');
    });
});


Route::get('/', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('post/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
