<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Categorie;
use App\Models\Chambre;
use App\Models\Client;
use App\Models\Equippement;
use App\Models\Facture;
use App\Models\Personnel;
use App\Models\Reservation;
use App\Models\Salle;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }


        ////////////////////////////////////////////////////////////

        $now = Carbon::now();

        $reservationsEnCours = Reservation::where('date_depart', '>', $now)
            ->where('date_arrivee', '<=', $now)
            ->count();

        $reservationsAVenir = Reservation::where('date_arrivee', '>', $now)
            ->where('date_depart', '>', $now)
            ->count();

        $reservationsArrivees = Reservation::where('date_arrivee', '<=', $now)
            ->where('date_depart', '>', $now)
            ->count();

        $reservationsParties = Reservation::where('date_depart', '<', $now)
            ->count();

        ////////////////////////////////////

        $statReservations = Reservation::selectRaw("DATE_FORMAT(date_arrivee, '%Y-%m') as month, COUNT(*) as total")
        ->groupBy(DB::raw("DATE_FORMAT(date_arrivee, '%Y-%m')"))
        ->get();
        $statReservations->transform(function ($item) {
            $carbonDate = Carbon::createFromFormat('Y-m', $item->month);
            $item->month = $carbonDate->translatedFormat('F Y');
            return $item;
        });



        ////////////////////////////////////////////////////////////

        $factures = Facture::orderBy('created_at')->get();
        $statFactures = [];
        $dates = [];
        $montants = [];
        foreach ($factures as $facture) {
            $dates[] = $facture->created_at->format('Y-m-d');
            $montants[] = $facture->montant;
        }

        $statFactures = ['dates' => $dates, 'montants' => $montants];

        ////////////////////////////////////////////////////////////

        $dataReservations = Reservation::get(['id', 'reference', 'date_arrivee', 'date_depart']);
        $statChambre = [
            Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Disponible");
            })->count(),

            Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Occupée");
            })->count(),

            Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Maintenance");
            })->count(),
        ];
        $statSalle = [
            Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Disponible");
            })->count(),

            Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Occupée");
            })->count(),

            Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Maintenance");
            })->count(),
        ];
        $data = [
            'statFactures' => $statFactures,
            'statChambre' => $statChambre,
            'statSalle' => $statSalle,
            'labels' => ['Disponible',  'Occupée', 'Maintenance'],
            'dataReservations' => $dataReservations,
            'reservations' => Reservation::orderBy('created_at', 'desc')->limit(3)->get(),
            'categories' => Categorie::orderBy('created_at', 'desc')->limit(3)->get(),
            'chambresCount' => Chambre::count(),
            'chambres' => Chambre::orderBy('created_at', 'desc')->limit(3)->get(),
            'allChambres' => Chambre::all(),
            'chambresDispo' => Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Disponible");
            })->count(),
            'chambresOccupees' => Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Occupée");
            })->count(),
            'chambresEnMaintenance' => Chambre::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Maintenance");
            })->count(),
            'sallesCount' => Salle::count(),
            'salles' => Salle::orderBy('created_at', 'desc')->limit(3)->get(),
            'allSalles' => Salle::all(),
            'sallesDispo' => Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Disponible");
            })->count(),
            'sallesOccupees' => Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Occupée");
            })->count(),
            'sallesEnMaintenance' => Salle::whereHas('reservable.etat', function ($query) {
                $query->where('etat', '=', "Maintenance");
            })->count(),
            'clients' => Client::orderBy('created_at', 'desc')->limit(3)->get(),
            'factures' => Facture::orderBy('created_at', 'desc')->limit(3)->get(),
            'equippements' => Equippement::orderBy('created_at', 'desc')->limit(3)->get(),
            'personnels' => Personnel::orderBy('created_at', 'desc')->limit(3)->get(),
            'services' => Service::orderBy('created_at', 'desc')->limit(3)->get(),
        ];


        return view('admin.index', [
            'data' => $data,
            'reservationsEnCours' => $reservationsEnCours,
            'reservationsAVenir' => $reservationsAVenir,
            'reservationsArrivees' => $reservationsArrivees,
            'reservationsParties' => $reservationsParties,
            'statReservations'=> $statReservations
        ]);
    }




    public function calendrier(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $reservationData = [];
        if ($request->reservable == 'all' || $request->reservable == null) {
            $reservable = 'all';
            $statReservations = Reservation::all();
            foreach ($statReservations as $statReservation) {
                $reservationData[] = [
                    'date_arrivee' => $statReservation->date_arrivee,
                    'date_depart' => $statReservation->date_depart,
                    'nom' => $statReservation->client->user->prenom . ' ' . $statReservation->client->user->nom,
                    'reservable' => $statReservation->reservable->numero,
                ];
            }
        } else {
            $statReservations = Reservation::where('reservable_id', '=', $request->reservable)->get();
            $reservable = $request->reservable;

            foreach ($statReservations as $statReservation) {
                $reservationData[] = [
                    'date_arrivee' => $statReservation->date_arrivee,
                    'date_depart' => $statReservation->date_depart,
                    'nom' => $statReservation->client->user->prenom . ' ' . $statReservation->client->user->nom,
                    'reservable' => $statReservation->reservable->numero,
                ];
            }
        }



        $data = [
            'statReservations' => $reservationData,
            'allChambres' => Chambre::all(),
            'salles' => Salle::orderBy('created_at', 'desc')->limit(3)->get(),
            'allSalles' => Salle::all(),
        ];


        return view('admin.calendrier', [
            'data' => $data,
            'reservable' => $reservable
        ]);
    }
}
