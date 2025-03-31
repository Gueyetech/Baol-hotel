<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\ChambreController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\EquippementController;
use App\Http\Controllers\admin\PersonnelController;
use App\Http\Controllers\admin\ReservationController;
use App\Http\Controllers\admin\SalleController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\FactureController;
use App\Http\Controllers\FactureController as ControllersFactureController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {

    Route::get("/", [AdminController::class, "index"])->name("index");
    Route::get("/calendrier", [AdminController::class, "calendrier"])->name("calendrier");

    Route::prefix('/reservation')->name('reservation.')->group(function () {
        Route::get("/", [ReservationController::class, "index"])->name("index");
        Route::get("/filtre/{filtre}", [ReservationController::class, "filtre"])->name("filtre");
        Route::post("/recherche", [ReservationController::class, "recherche"])->name("recherche");
        Route::get("/create", [ReservationController::class, "create"])->name("create");
        Route::post("/store", [ReservationController::class, "store"])->name("store");
        Route::post("/showFormClient", [ReservationController::class, "showFormClient"])->name("showFormClient");
        Route::post("/createClient", [ReservationController::class, "createClient"])->name("createClient");
        Route::get("/show/{reservation}", [ReservationController::class, "show"])->name("show");
    });

    Route::prefix('/facture')->name('facture.')->group(function () {
        Route::post("/recherche", [FactureController::class, "recherche"])->name("recherche");
        Route::get("/createFacture/{reservation}", [FactureController::class, "createFacture"])->name("createFacture");
        Route::post("/ajouterService", [FactureController::class, "ajouterService"])->name("ajouterService");
        Route::get("/{facture}/show", [FactureController::class, "show"])->name("show");
        Route::get("/{facture}/ajouterServiceForm", [FactureController::class, "ajouterServiceForm"])->name("ajouterServiceForm");
        Route::get("/{facture}/formPayFacture", [FactureController::class, "formPayFacture"])->name("formPayFacture");
        Route::post("/{facture}", [FactureController::class, "payerFacture"])->name("payerFacture");
        Route::get("/{facture}/pdf", [FactureController::class, "pdf"])->name("pdf");
    });


    Route::prefix('/service')->name('service.')->group(function () {
        Route::get("/", [ServiceController::class, "index"])->name("index");
        Route::post("/recherche", [ServiceController::class, "recherche"])->name("recherche");
        Route::get("/create", [ServiceController::class, "create"])->name("create");
        Route::post("/", [ServiceController::class, "store"])->name("store");
        Route::get("/{service}/edit", [ServiceController::class, "edit"])->name("edit");
        Route::get("/{service}", [ServiceController::class, "update"])->name("update");
        Route::delete("/{service}", [ServiceController::class, "destroy"])->name("destroy");
    });


    Route::prefix('/categorie')->name('categorie.')->group(function () {
        Route::post("/recherche", [CategorieController::class, "recherche"])->name("recherche");
        Route::get("/", [CategorieController::class, "index"])->name("index");
        Route::get("/create", [CategorieController::class, "create"])->name("create");
        Route::post("/", [CategorieController::class, "store"])->name("store");
        Route::get("/{categorie}/edit", [CategorieController::class, "edit"])->name("edit");
        Route::get("/{categorie}", [CategorieController::class, "update"])->name("update");
        Route::delete("/{categorie}", [CategorieController::class, "destroy"])->name("destroy");
    });

    Route::prefix('/chambre')->name('chambre.')->group(function () {
        Route::get("/", [ChambreController::class, "index"])->name("index");
        Route::post("/recherche", [ChambreController::class, "recherche"])->name("recherche");
        Route::get("/create", [ChambreController::class, "create"])->name("create");
        Route::post("/", [ChambreController::class, "store"])->name("store");
        Route::get("/{chambre}/edit", [ChambreController::class, "edit"])->name("edit");
        Route::get("/{chambre}", [ChambreController::class, "update"])->name("update");
        Route::delete("/{chambre}", [ChambreController::class, "destroy"])->name("destroy");
    });

    Route::prefix('/salle')->name('salle.')->group(function () {
        Route::get("/", [SalleController::class, "index"])->name("index");
        Route::post("/recherche", [SalleController::class, "recherche"])->name("recherche");
        Route::get("/create", [SalleController::class, "create"])->name("create");
        Route::post("/", [SalleController::class, "store"])->name("store");
        Route::get("/{salle}/edit", [SalleController::class, "edit"])->name("edit");
        Route::get("/{salle}", [SalleController::class, "update"])->name("update");
        Route::delete("/{salle}", [SalleController::class, "destroy"])->name("destroy");
    });

    Route::prefix('/personnel')->name('personnel.')->group(function () {
        Route::post("/recherche", [PersonnelController::class, "recherche"])->name("recherche");
        Route::get("/", [PersonnelController::class, "index"])->name("index");
        Route::get("/create", [PersonnelController::class, "create"])->name("create");
        Route::post("/", [PersonnelController::class, "store"])->name("store");
        Route::get("/{personnel}/edit", [PersonnelController::class, "edit"])->name("edit");
        Route::get("/{personnel}", [PersonnelController::class, "update"])->name("update");
        Route::delete("/{personnel}", [PersonnelController::class, "destroy"])->name("destroy");
    });

    Route::prefix('/client')->name('client.')->group(function () {
        Route::get("/", [ClientController::class, "index"])->name("index");
        Route::post("/recherche", [ClientController::class, "recherche"])->name("recherche");
        Route::get("/create", [ClientController::class, "create"])->name("create");
        Route::post("/", [ClientController::class, "store"])->name("store");
        Route::get("/{client}/edit", [ClientController::class, "edit"])->name("edit");
        Route::get("/{client}", [ClientController::class, "update"])->name("update");
        Route::delete("/{client}", [ClientController::class, "destroy"])->name("destroy");
    });


    Route::prefix('/equippement')->name('equippement.')->group(function () {
        Route::post("/recherche", [EquippementController::class, "recherche"])->name("recherche");
        Route::get("/", [EquippementController::class, "index"])->name("index");
        Route::get("/create", [EquippementController::class, "create"])->name("create");
        Route::post("/", [EquippementController::class, "store"])->name("store");
        Route::get("/{equippement}/edit", [EquippementController::class, "edit"])->name("edit");
        Route::get("/{equippement}", [EquippementController::class, "update"])->name("update");
        Route::delete("/{equippement}", [EquippementController::class, "destroy"])->name("destroy");
    });
});
