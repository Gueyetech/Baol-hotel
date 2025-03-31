<x-mail::message>

Cher(e)  {{ $facture->reservation->client->user->prenom }} {{ $facture->reservation->client->user->nom }},

Nous avons le plaisir de vous informer que votre paiement d'un facture pour la  réservation {{ $facture->reservation->reference }}  a bien été enregistrée. Voici les détails de la facture :</br>

    Date de création    : {{ $facture->created_at() }}
    Réference           : {{ $facture->ref }}
    Montant             : {{ $facture->montant }}

Si vous avez des questions supplémentaires ou si vous souhaitez apporter des modifications à votre réservation, n’hésitez pas à nous contacter.</br>

Nous vous remercions pour votre confiance et nous sommes impatients de vous accueillir lors de cet événement.

Cordialement
Gestion des réservation
BAOL HOTEL,
Gawane, Mbacké, Diourbel, Sénégale


</x-mail::message>
