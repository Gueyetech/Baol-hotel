<x-mail::message>

    Cher {{ $facture->reservation->client->user->prenom }} {{ $facture->reservation->client->user->nom }},

    Nous vous remercions d'avoir choisi BAOL HOTEL pour votre séjour.
    Nous sommes heureux de confirmer votre réservation ainsi que les détails de votre facture associée.
    Détails de la réservation :

    Référence de la réservation : {{ $facture->reservation->reference }}
    Date d'arrivée : {{ $facture->reservation->date_arrivee() }}
    Date de départ : {{ $facture->reservation->date_depart() }}
    @if ($facture->reservation->adulte != null)
    Nombre d'adultes : {{ $facture->reservation->adulte }}
    @if ($facture->reservation->enfant != null)
    Nombre d'enfants : {{ $facture->reservation->enfant }}
    @endif
    Type de réservation : Chambre
    @else
    Type de réservation : Salle
    @endif

    Si vous avez des questions ou si vous avez besoin d'informations supplémentaires,
    n'hésitez pas à nous contacter à reservation@baolhotel.sn.
    Nous sommes impatients de vous accueillir et nous nous engageons à
    rendre votre séjour aussi agréable et confortable que possible.

    Cordialement,

    Gestion des réservation
    BAOL HOTEL,

    Gawane, Mbacké, Diourbel, Sénégale

</x-mail::message>
