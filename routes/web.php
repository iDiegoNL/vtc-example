<?php

use App\Http\Controllers\CompanyApplicationController;
use App\Http\Controllers\CompanyResourceController;
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

Route::resource('vtc', CompanyResourceController::class)->parameters(['vtc' => 'company']);
Route::prefix('vtc/{company}')->name('vtc.')->group(function () {
    Route::post('leave', [CompanyResourceController::class, 'leave'])
        ->middleware('auth')
        ->name('leave');
});

Route::resource('vtc.applications', CompanyApplicationController::class)
    ->parameters(['vtc' => 'company'])
    ->except([
        'create', 'edit', 'destroy'
    ]);
