<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use App\Models\Reservable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function verification(Request $request)
    {
        $request->validate([
            'date_arrivee' => ['required', 'date', 'after_or_equal:today'],
            'date_depart' => ['required', 'date', 'after_or_equal:date_arrivee'],
        ]);


        $dateArrivee = Carbon::parse($request->date_arrivee);
        $dateDepart = Carbon::parse($request->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        if ($nombreDeJours === 0) {
            $nombreDeJours = 1;
        }

        $data = [
            'typeReservable' => $request->typeReservable,
            'date_arrivee' => $request->date_arrivee,
            'date_depart' => $request->date_depart,
            'adulte' => $request->adulte,
            'enfant' => $request->enfant,
            'nombre' => $request->adulte + $request->enfant,
            'nombreDeJours' => $nombreDeJours
        ];

        if ($data['typeReservable'] === 'salle') {
            $reservables = Reservable::whereHas('salle', function ($query) use ($data) {
            })
                ->whereDoesntHave('reservations', function ($query) use ($data) {
                    $query->where(function ($subQuery) use ($data) {
                        $subQuery->whereBetween('date_arrivee', [$data['date_arrivee'], $data['date_depart']])
                            ->orWhereBetween('date_depart', [$data['date_arrivee'], $data['date_depart']]);
                    })->orWhere(function ($subQuery) use ($data) {
                        $subQuery->where('date_arrivee', '<=', $data['date_depart'])
                            ->where('date_depart', '=>', $data['date_arrivee']);
                    });
                });
        } else {
            $reservables = Reservable::where('capacite', '>=', $data['nombre'])
                ->whereHas('chambre', function ($query) use ($data) {
                })->whereDoesntHave('reservations', function ($query) use ($data) {
                    $query->where(function ($subQuery) use ($data) {
                        $subQuery->whereBetween('date_arrivee', [$data['date_arrivee'], $data['date_depart']])
                            ->orWhereBetween('date_depart', [$data['date_arrivee'], $data['date_depart']]);
                    })->orWhere(function ($subQuery) use ($data) {
                        $subQuery->where('date_arrivee', '<=', $data['date_depart'])
                            ->where('date_depart', '=>', $data['date_arrivee']);
                    });
                });
        }
        $reservables = $reservables->get();

        // if ($reservables->count() == 0) {
        //     return redirect()->back()->with('data', $data)->with('message', 'Vérifier les détaille entrer !');
        // }


        return view('user.reservation.disponible', [
            'reservables' => $reservables,
            'data' => $data
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->validate(['option' => ['required']]);
        $reservable = Reservable::find($request->option);

        $data = $request->data;

        $data['tarif'] = $reservable->tarif;
        $data['option'] = $request->option;
        $data['client'] = 0;
        $data['facture'] = 0;
        $user = Auth::user();
        if (Auth::user()) {
            if (Auth::user()->client != null) {
                $data['client'] = Auth::user()->client->id;
                return view('user.reservation.payement', [
                    'data' => $data
                ]);
            }
        }

        return view('user.reservation.infoclient', [
            'data' => $data
        ]);
    }


    public function createClient(Request $request)
    {
        $data = $request->data;

        // $request->validate([
        //     'prenom' => ['required'],
        //     'nom' => ['required'],
        //     'email' => ['required'],
        //     'adresse' => ['required'],
        //     'tel' => ['required'],
        //     'genre' => ['required'],
        //     'ville' => ['required'],
        //     'pays' => ['required'],
        // ]);


        $data['prenom'] = $request->prenom;
        $data['nom'] = $request->nom;
        $data['email'] = $request->email;
        $data['adresse'] = $request->adresse;
        $data['tel'] = $request->tel;
        $data['role_id'] = 3;

        $data['genre'] = $request->genre;
        $data['ville'] = $request->ville;
        $data['pays'] = $request->pays;
        return view('user.reservation.payement', [
            'data' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function loginForm(Request $request)
    {
        $data = json_decode($request->string);

        // dd($data);
        return view('user.reservation.login', [
            'data' => $data
        ]);
    }

    // <form method="POST" class="max-w-sm mx-auto" action="{{ route('reservation.login',['data'=> $data]) }}">


    public function login(LoginRequest $request)
    {
        $data = $request->data;
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        $data['client'] = $user->client->id;
        return view('user.reservation.payement', [
            'data' => $data
        ]);
    }

    public function retour(String $url)
    {
        return to_route($url);
    }
}
