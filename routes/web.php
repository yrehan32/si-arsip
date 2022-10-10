<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\Ajax\ArsipSuratController as AjaxArsipSurat;
use App\Http\Controllers\Datatables\ArsipSuratController as DtArsipSurat;

use App\Http\Controllers\WebController;
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

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('register', [RegisteredUserController::class, 'store']);
// });

Route::middleware('auth')->group(function () {
    Route::get('/', [WebController::class, 'arsipSuratList'])->name('web.arsip-surat.list');
    Route::get('/about', [WebController::class, 'about'])->name('web.about');
    
    Route::group(['prefix' => 'arsip-surat'], function() {
        Route::get('/create', [WebController::class, 'arsipSuratCreate'])->name('web.arsip-surat.create');
        Route::get('/show/{id}', [WebController::class, 'arsipSuratShow'])->name('web.arsip-surat.show');
        Route::get('/download/{id}', [WebController::class, 'arsipSuratDownload'])->name('web.arsip-surat.download');
    });
    
    Route::group(['prefix' => 'ajax'], function() {
        Route::post('/arsip-surat/store', [AjaxArsipSurat::class, 'store'])->name('ajax.arsip-surat.store');
        Route::post('/arsip-surat/update/{id}', [AjaxArsipSurat::class, 'update'])->name('ajax.arsip-surat.update');
        Route::delete('/arsip-surat/delete', [AjaxArsipSurat::class, 'delete'])->name('ajax.arsip-surat.delete');
    });
    
    Route::group(['prefix' => 'dt-ajax'], function() {
        Route::get('/arsip-surat', [DtArsipSurat::class, 'getArsipList'])->name('dt-ajax.arsip-surat');
    });
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
