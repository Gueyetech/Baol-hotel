<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\FactureParMail;
use App\Mail\NewClient;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Reservable;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.reservation.index', [
            'reservations' => $reservations,
            'recherche' => ''

        ]);
    }
    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'recherche' => ['required', 'min:2'],
        ]);
        $dateAujourdhui = Carbon::now()->format('Y-m-d');

        if ($request->recherche == 'En cours') {
            $reservations = Reservation::whereDate('date_arrivee', '<=', $dateAujourdhui)
                ->whereDate('date_depart', '>=', $dateAujourdhui)
                ->get();
        } elseif ($request->recherche == 'Arrivée') {
            $reservations = Reservation::whereDate('date_arrivee', '=', $dateAujourdhui)
                ->get();
        } elseif ($request->recherche == 'Départ') {
            $reservations = Reservation::whereDate('date_depart', '<', $dateAujourdhui)
                ->get();
        } else {
            $reservations = Reservation::where('reference', 'like', "%$request->recherche%")
                ->where('reference', 'like', "%$request->recherche%")
                ->orwhere('reference', 'like', "%$request->recherche%")
                ->orwhere('date_arrivee', 'like', "%$request->recherche%")
                ->orwhere('date_depart', 'like', "%$request->recherche%")
                ->orwhere('status', 'like', "%$request->recherche%")
                ->get();
        }

        // dd($reservations);


        return view('admin.reservation.recherche', [
            'reservations' => $reservations,
            'recherche' => $request->recherche
        ]);
    }
    public function filtre(String $filtre)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $dateAujourdhui = Carbon::now()->format('Y-m-d');

        if ($filtre == 'En cours') {
            $reservations = Reservation::whereDate('date_arrivee', '<=', $dateAujourdhui)
                ->whereDate('date_depart', '>=', $dateAujourdhui)
                ->paginate(6);
        } elseif ($filtre == 'Arrivée') {
            $reservations = Reservation::whereDate('date_arrivee', '=', $dateAujourdhui)
                ->paginate(6);
        } elseif ($filtre == 'Départ') {
            $reservations = Reservation::whereDate('date_depart', '=', $dateAujourdhui)
                ->paginate(6);
        } elseif ($filtre == 'Passés') {
            $reservations = Reservation::whereDate('date_depart', '<', $dateAujourdhui)
                ->paginate(6);
        }

        return view('admin.reservation.index', [
            'reservations' => $reservations,
            'recherche' => ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.reservation.create');
    }

    /**
     * rsecuper les information relatif a la reservation
     * pour afficher les reservables disponibles
     */
    public function store(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $request->validate([
            'date_arrivee' => ['required', 'date', 'after_or_equal:today'],
            'date_depart' => ['required', 'after_or_equal:date_arrivee'],
        ]);

        $dateArrivee = Carbon::parse($request->date_arrivee);
        $dateDepart = Carbon::parse($request->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        if ($nombreDeJours == 0) {
            $nombreDeJours = 1;
        }
        $data = [
            'typeReservable' => $request->typeReservable,
            'date_arrivee' => $request->date_arrivee,
            'date_depart' => $request->date_depart,
            'nombreDeJours' => $nombreDeJours
        ];
        if ($data['typeReservable'] == 'chambre') {

            $request->validate([
                'adulte' => ['required'],
                'enfant' => ['required'],
            ]);

            $data['adulte'] = $request->adulte;
            $data['enfant'] = $request->enfant;
            $data['nombre'] = $request->adulte + $request->enfant;
        }

        if ($data['typeReservable'] === 'salle') {
            $reservables = Reservable::whereHas('salle', function ($query) use ($data) {
            })->whereDoesntHave('reservations', function ($query) use ($data) {
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

        return view('admin.reservation.disponible', [
            'reservables' => $reservables,
            'data' => $data,
        ]);
    }


    /**
     * Enregister le reservable choisi et
     *  affiche le formulaire pour recuperer les info du client
     */
    public function showFormClient(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $reservable = Reservable::find($request->option);
        $data = $request->data;
        $data['tarif'] = $reservable->tarif;
        $data['option'] = $request->option;

        return view('admin.reservation.infoclient', [
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     */
    // public function createClient(Request $request, Reservation $reservation)

    public function createClient(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $data = $request->data;
        $data['prenom'] = $request->prenom;
        $data['nom'] = $request->nom;
        $data['email'] = $request->email;
        $data['adresse'] = $request->adresse;
        $data['tel'] = $request->tel;
        $data['role_id'] = 3;

        $data['genre'] = $request->genre;
        $data['ville'] = $request->ville;
        $data['pays'] = $request->pays;

        $countClient = Client::whereHas('user', function ($query)  use ($data) {
            $query->where('email', '=', $data['email']);
        })->count();
        $reservation = new Reservation();
        $reservation->date_arrivee = $data['date_arrivee'];
        $reservation->date_depart = $data['date_depart'];
        $reservation->reference = 'BH' . time() . $data['date_arrivee'];
        if ($data['typeReservable'] == 'chambre') {
            $reservation->adulte = $data['adulte'];
            $reservation->enfant = $data['enfant'];
            $reservation->nombre = $data['adulte'] + $data['enfant'];
        }
        $reservation->reservable_id = $data['option'];
        if ($countClient == 0) {

            $user = new User();
            $user->prenom = $data['prenom'];
            $user->nom = $data['nom'];
            $user->email = $data['email'];
            $user->adresse = $data['adresse'];
            $user->tel = $data['tel'];
            $user->genre = $data['genre'];
            $user->role_id = 3;
            $password = bin2hex(random_bytes(5));
            $user->password = Hash::make($password);
            $user->save();

            $client = new Client();
            $client->ville = $data['ville'];
            $client->pays = $data['pays'];
            $client->active = 'active';
            $client->user_id = $user->id;
            $client->save();

            Mail::send(new NewClient($client, $password));

            $reservation->client_id = $client->id;
        } else {
            $Client = Client::whereHas('user', function ($query)  use ($data) {
                $query->where('email', '=', $data['email']);
            })->first();
            $reservation->client_id = $Client->id;
        }

        $reservation->status = 'non payé';
        $reservation->save();

        $facture = new Facture();
        $facture->ref = 'BH' . time() . 'TCF';
        $facture->status = 'non payé';
        $facture->montant = $data['nombreDeJours']  * $data['tarif'];
        $facture->reservation_id = $reservation->id;
        $facture->save();

        Mail::send(new FactureParMail($facture));

        return to_route('admin.reservation.show', [
            'reservation' => $reservation
        ]);
    }

    /**
     * Afficher le detaille d'une reservation donnée.
     */

    public function show(Reservation $reservation)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.reservation.show', [
            'reservation' => $reservation
        ]);
    }
}
