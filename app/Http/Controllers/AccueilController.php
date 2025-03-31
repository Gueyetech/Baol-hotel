<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Categorie;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Reservable;
use App\Models\Reservation;
use App\Models\Salle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccueilController extends Controller
{

    public function index(): View
    {
        $avis = Avis::all();
        $salles = Salle::limit(6)->get();
        $chambres = Chambre::limit(6)->get();
        // dd($avis);
        return view("welcome", [
            'avis' => $avis,
            'salles' => $salles,
            'chambres' => $chambres,
            'reservation' => new Reservation()
        ]);
    }
    public function about(): View
    {
        return view('user.about');
    }
    public function service(): View
    {
        return view('user.service');
    }
    public function categorie(): View
    {
        $categories = Categorie::all();
        return view('user.categorie', [
            'categories' => $categories
        ]);
    }
    // public function contact(): View
    // {
    //     return view('user.detaille');
    // }

    public function reservation()
    {
        if (Auth::user()->role->role != 'client') {
            return redirect()->back();
        }
        $client = Auth::user()->client;
        $reservations = Reservation::orderBy('created_at', 'desc')->whereHas('client', function ($query) use ($client) {
            $query->where('client_id', '=', $client->id);
        })->paginate(2);
        return view('user.reservation', [
            'reservations' => $reservations
        ]);
    }


    public function show(Reservation $reservation)
    {
        if (Auth::user()->role->role != 'client') {
            return redirect()->back();
        }
        return view('user.reservation.show', [
            'reservation' => $reservation
        ]);
    }

    public function showDetaille(Reservable $reservable)
    {
        if ($reservable->salle != null) {
            $type = 'SALLE';
        } else {
            $type = 'CHAMBRE';
        }
        $data = [
            'date_arrivee' => '',
            'date_depart' => '',
            'adulte' => '',
            'enfant' => '',
        ];

        return view('user.detaille', [
            'reservable' => $reservable,
            'type' => $type,
            'data' => $data
        ]);
    }


    public function facture(Facture $facture)
    {
        if (Auth::user()->role->role != 'client') {
            return redirect()->back();
        }
        $dateArrivee = Carbon::parse($facture->reservation->date_arrivee);
        $dateDepart = Carbon::parse($facture->reservation->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        $totalMontantService = $facture->services->sum(function ($service) {
            return $service->pivot->nbre * $service->prix;
        });
        return view('user.reservation.facture', [
            'facture' => $facture,
            'nombreDeJours' => $nombreDeJours,
            'totalMontantService' => $totalMontantService
        ]);
    }


    public function avis(Request $request)
    {
        if (Auth::user()->role->role != 'client') {
            return redirect()->back();
        }
        $request->validate([
            // 'prenom' => ['required', 'min:3'],
            'evaluation' => ['required', 'integer'],
            'avis' => ['required', 'min:10'],
        ]);

        $avis = new Avis();
        $avis->message = $request->avis;
        $avis->evaluation = $request->evaluation;
        $avis->client_id = Auth::user()->client->id;
        $avis->save();
        return redirect()->back()->with('message','Votre avis a étè enregistrer avec succés.');
    }
}
