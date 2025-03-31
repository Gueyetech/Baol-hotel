<?php

namespace App\Http\Controllers;

use App\Mail\FactureParMail;
use App\Mail\NewClient;
use App\Mail\PaiementFacture;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $data = $request->data;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', ['data' => $data]),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $data['nombreDeJours'] * $data['tarif'] / 500
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        $data = $request->data;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

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

            if ($data['client'] == 0) {
                $user = new User();
                $password = bin2hex(random_bytes(5));
                $user->prenom = $data['prenom'];
                $user->nom = $data['nom'];
                $user->email = $data['email'];
                $user->adresse = $data['adresse'];
                $user->tel = $data['tel'];
                $user->genre = $data['genre'];
                $user->role_id = 3;
                $user->password = Hash::make($password);
                $user->save();

                $client = new Client();
                $client->ville = $data['ville'];
                $client->pays = $data['pays'];
                $client->active = 'active';
                $client->user_id = $user->id;
                $client->save();

                $reservation->client_id = $client->id;
                Auth::login($user);
                Mail::send(new NewClient($client, $password));
            } else {
                $reservation->client_id = $data['client'];
            }

            $reservation->status = 'payé';
            $reservation->save();

            // CREATION DE FACTURE

            $facture = new Facture();
            $facture->ref = 'BH' . time() . 'TCF';
            $facture->status = 'payé';
            $facture->montant = $data['nombreDeJours']  * $data['tarif'];
            $facture->reservation_id = $reservation->id;
            $facture->save();

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

            //FIN CREATION DE FACTURE

            // ENVOI DE MAIL

            Mail::send(new FactureParMail($facture));
            Mail::send(new PaiementFacture($facture));

            return redirect()
                ->route('reservation.show', ['reservation' => $reservation]);
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Le payement a echoué');
        }
    }
}
