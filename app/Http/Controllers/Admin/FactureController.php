<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\FactureParMail;
use App\Mail\PaiementFacture;
use App\Mail\PayementFacture;
use App\Models\Facture;
use App\Models\Reservation;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function createFacture(Reservation $reservation)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $facture = new Facture();
        $facture->ref = 'BH' . time() . 'TCF';
        $facture->reservation_id = $reservation->id;
        $facture->montant = 0;
        $facture->save();
        $reservation->status = 'non payé';
        $reservation->save();

        return to_route('admin.reservation.show', [
            'reservation' => $reservation
        ])->with('message', 'Facture a étè ajouté au réservation avec succés');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function formPayFacture(Facture $facture)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        if ($facture->montant == 0) {
            return redirect()->back();
        }
        return view('admin.reservation.formPayFacture', [
            'facture' => $facture
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function payerFacture(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $facture = Facture::find($request->facture);

        $reservation = $facture->reservation;

        $facture->status = 'payé';

        $dateArrivee = Carbon::parse($facture->reservation->date_arrivee);
        $dateDepart = Carbon::parse($facture->reservation->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        if ($nombreDeJours == 0) {
            $nombreDeJours = 1;
        }
        $client = $facture->reservation->client;
        $totalMontantService = $facture->services->sum(function ($service) {
            return $service->pivot->nbre * $service->prix;
        });
        $montant = $facture->reservation->reservable->tarif;
        $services = $facture->services;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.reservation.pdf', compact(['facture', 'client', 'services', 'reservation', 'montant', 'nombreDeJours', 'totalMontantService']));
        $pdf->render();

        $dossier = 'pdfs/';
        $path = public_path($dossier);
        !is_dir($path) && mkdir($path, 0755, true);
        $facture->path = 'pdfs/FCT' . $facture->id .  time() . '.pdf';
        $pdf->save(public_path($facture->path));

        $facture->update();
        Mail::send(new PaiementFacture($facture));


        $facturesNonPayees = $reservation->factures->where('status', 'non payé');
        if ($facturesNonPayees->isEmpty()) {
            $reservation->status = 'payé';
        } else {
            $reservation->status = 'non payé';
        }
        $reservation->update();

        return to_route('admin.reservation.show', [
            'reservation' => $reservation
        ])->with('message','Le paiement du facture a étè validé avec succés');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function ajouterServiceForm(Facture $facture)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.reservation.ajouterService', [
            'services' => Service::all(),
            'facture' => $facture
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    // Méthode pour ajouter un service à une facture
    public function ajouterService(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'nbre' => ['required', 'integer']
        ]);
        $facture = Facture::find($request->facture);
        $service = Service::find($request->service);
        $nbre = $request->nbre;

        $factureService = $facture->services()->where('service_id', '=', $service->id)->first();

        if ($factureService) {
            $pivotNbre = $facture->services()->where('service_id', '=', $service->id)->first()->pivot->nbre;
            $facture->services()->syncWithoutDetaching([$service->id => ['nbre' => $pivotNbre + $nbre]]);
        } else {
            $facture->services()->attach($service->id, ['nbre' => $nbre]);
        }

        $facture->montant += $nbre * $service->prix;
        $facture->update();

        return to_route('admin.reservation.show', [
            'reservation' => $facture->reservation
        ])->with('message', 'Service ajouter avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        if (Auth::user()->role->role != 'receptionniste' &&  Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $dateArrivee = Carbon::parse($facture->reservation->date_arrivee);
        $dateDepart = Carbon::parse($facture->reservation->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        if ($nombreDeJours == 0) {
            $nombreDeJours = 1;
        }
        $totalMontantService = $facture->services->sum(function ($service) {
            return $service->pivot->nbre * $service->prix;
        });
        return view('admin.reservation.facture', [
            'facture' => $facture,
            'nombreDeJours' => $nombreDeJours,
            'totalMontantService' => $totalMontantService
        ]);
    }



    /**
     * Display the specified resource.
     */

    public function pdf(Facture $facture)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'client' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $dateArrivee = Carbon::parse($facture->reservation->date_arrivee);
        $dateDepart = Carbon::parse($facture->reservation->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee);
        $montant = $facture->reservation->reservable->tarif;
        $client = $facture->reservation->client;
        $totalMontantService = $facture->services->sum(function ($service) {
            return $service->pivot->nbre * $service->prix;
        });
        $reservation = $facture->reservation;
        $services = $facture->services;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.reservation.pdf', compact(['facture', 'client', 'services', 'reservation', 'montant', 'nombreDeJours', 'totalMontantService']));
        return $pdf->stream();
    }
}
