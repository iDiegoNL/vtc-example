<?php

use App\Http\Controllers\CompanyController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('vtc', CompanyController::class)->parameters(['vtc' => 'company']);
Route::prefix('vtc/{company}')->name('vtc.')->group(function () {
    Route::post('leave', [CompanyController::class, 'leave'])->middleware('auth')->name('leave');
});
