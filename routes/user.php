<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\user\UserReservationController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AccueilController::class, "index"])->name("acceuil");
Route::get("/about", [AccueilController::class, "about"])->name("about");
Route::get("/service", [AccueilController::class, "service"])->name("service");
Route::get("/categorie", [AccueilController::class, "categorie"])->name("categorie");
Route::get("/show/detaille/{reservable}", [AccueilController::class, "showDetaille"])->name("show.detaille");

Route::prefix('/reservation')->name('reservation.')->group(function () {
    Route::get("/verification", [UserReservationController::class, 'verification'])->name('verification');
    Route::post("/choisir", [UserReservationController::class, 'create'])->name('create');
    Route::post("/create/client", [UserReservationController::class, 'createClient'])->name('createClient');
    Route::post("/payememt/store", [UserReservationController::class, 'payerReservation'])->name('payerReservation');
    Route::get("/login", [UserReservationController::class, 'loginForm'])->name('loginForm');
    Route::post("/login", [UserReservationController::class, 'login'])->name('login');
    Route::get("/retour/{url}", [UserReservationController::class, 'retour'])->name('retour');
});

Route::middleware('auth')->group(function () {
    Route::post("/avis", [AccueilController::class, "avis"])->name("avis");
    Route::get("/reservation", [AccueilController::class, "reservation"])->name('reservation');
    Route::get("/reservation/show/{reservation}", [AccueilController::class, "show"])->name("reservation.show");
    Route::get("/reservation/{facture}/show", [AccueilController::class, "facture"])->name("user.facture.show");
});
