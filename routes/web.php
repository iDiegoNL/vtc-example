<?php

use App\Http\Controllers\CompanyApplicationResourceController;
use App\Http\Controllers\CompanyResourceController;
use App\Http\Controllers\EventRequestResourceController;
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

Route::prefix('vtc/{company}/applications/{companyApplication}')->name('vtc.applications.')->middleware('auth')->group(function () {
    Route::post('assign', [CompanyApplicationResourceController::class, 'assign'])->name('assign');
    Route::post('comment', [CompanyApplicationResourceController::class, 'comment'])->name('comment');
});

Route::resource('vtc.applications', CompanyApplicationResourceController::class)
    ->middleware('auth')
    ->parameters([
        'vtc' => 'company',
        'applications' => 'companyApplication',
    ])
    ->except([
        'create',
        'edit',
        'destroy',
    ]);

Route::resource('event-request', EventRequestResourceController::class)
    ->parameter('event-request', 'eventRequest')
    ->except([
        'edit',
        'destroy',
    ]);
