<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProfileController;
use Barryvdh\DomPDF\Facade\Pdf;
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


Route::get('/test', function () {
    return view('test');
})->name('test');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/information', [ProfileController::class, 'information'])->name('profile.information');
    Route::post('/profile/contact', [ProfileController::class, 'contact'])->name('profile.contact');
    Route::post('/profile/adresse', [ProfileController::class, 'adresse'])->name('profile.adresse');
    Route::post('/profile/changerImage', [ProfileController::class, 'changerImage'])->name('profile.changerImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware('auth')->group(function () {changerImage
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
