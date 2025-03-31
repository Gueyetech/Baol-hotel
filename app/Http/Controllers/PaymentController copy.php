<?php

namespace App\Http\Controllers;

use App\Mail\FactureParMail;
use App\Mail\NewClient;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                        "value" => $data['nombreDeJours'] * $data['tarif']
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
                $user->prenom = $data['prenom'];
                $user->nom = $data['nom'];
                $user->email = $data['email'];
                $user->adresse = $data['adresse'];
                $user->tel = $data['tel'];
                $user->role_id = 3;
                $user->save();
                $client = new Client();
                $client->genre = $data['genre'];
                $client->ville = $data['ville'];
                $client->pays = $data['pays'];
                $client->active = 'active';
                $client->user_id = $user->id;
                $client->save();
                $reservation->client_id = $client->id;
                Auth::login($user);

                $password = bin2hex(random_bytes(5));
                Mail::send(new NewClient($client, $password));

            } else {
                $reservation->client_id = $data['client'];
            }

            $reservation->status = 'payé';
            $reservation->save();

            $facture = new Facture();
            $facture->ref = 'BH' . time() . 'TCF';
            $facture->status = 'payé';
            $facture->montant = $data['nombreDeJours']  * $data['tarif'];
            $facture->reservation_id = $reservation->id;
            $facture->save();

            Mail::send(new FactureParMail($facture));

            return redirect()
                ->route('reservation.show',['reservation' => $reservation]);

        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
