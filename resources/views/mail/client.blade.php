<x-mail::message>


    Cher {{ $client->user->prenom }} {{ $client->user->nom }},

    Nous sommes ravis de vous accueillir sur notre plateforme ! Pour accéder à votre compte, veuillez utiliser les
    informations ci-dessous :

    - Identifiant : {{ $client->user->email }}
    - Mot de passe temporaire : {{ $password }}

    Veuillez vous connecter dès que possible et changer votre mot de passe pour
    des raisons de sécurité. Si vous avez des questions ou besoin d'assistance,
    n'hésitez pas à nous contacter.

    Cordialement,
    Gestion des réservation
    BAOL HOTEL,
    Gawane, Mbacké, Diourbel, Sénégale

</x-mail::message>
