<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Avis;
use App\Models\Categorie;
use App\Models\Chambre;
use App\Models\Client;
use App\Models\Equippement;
use App\Models\Etat;
use App\Models\Facture;
use App\Models\Personnel;
use App\Models\Reservable;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Salle;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CREATION DES ETATS DES RESERVABLES

        Etat::create([
            'etat' => 'Disponible'
        ]);
        Etat::create([
            'etat' => 'Occupée'
        ]);
        Etat::create([
            'etat' => 'Maintenance'
        ]);
        Role::create([
            'role' => 'admin'
        ]);
        Role::create([
            'role' => 'receptionniste'
        ]);
        Role::create([
            'role' => 'client'
        ]);
        Role::create([
            'role' => 'autre'
        ]);

        // CREATION DES ADMINS

        User::factory()->create([
            'prenom' => 'Mortalla',
            'nom' => 'GUEYE',
            'image' => 'bh/personnel/IMG-20230422-WA0033.jpg',
            'role_id' => 1,
            'email' => 'mortalla.gueye@baolhotel.sn'
        ]);
        User::factory()->create([
            'prenom' => 'Fallou',
            'nom' => 'GAYE',
            'role_id' => 1,
            'email' => 'fallougaye@baolhotel.sn'
        ]);
        User::factory(1)
            ->has(Personnel::factory()->count(1))
            ->create([
                'prenom' => 'kya',
                'nom' => 'Diop',
                'email' => 'kya@baolhotel.sn',
                'role_id' => 2
            ]);
        User::factory(5)
            ->has(Personnel::factory()->count(1))
            ->create([
                'role_id' => 4
            ]);


        User::factory(1)
            ->has(Client::factory()->count(1))
            ->create([
                'prenom' => 'Amadou Dieye',
                'nom' => 'SARR',
                'email' => 'ads@gmail.com',
                'role_id' => 3
            ]);
        User::factory(1)
            ->has(Client::factory()->count(1))
            ->create([
                'prenom' => 'Serigne Fallou',
                'nom' => 'Ndao',
                'email' => 'falloundao480@gmail.com',
                'role_id' => 3
            ]);
        User::factory(8)
            ->has(Client::factory()->count(1))
            ->create([
                'role_id' => 3
            ]);


        Reservable::factory()
            ->has(Salle::factory()->count(1))
            ->create([
                'numero' => 'S1',
                'etage' => 2,
                'capacite' => 39,
                'tarif' => 600,
            ]);

        Reservable::factory()
            ->has(Salle::factory()->count(1))
            ->create([
                'numero' => 'S2',
                'etage' => 3,
                'capacite' => 20,
                'tarif' => 300,
            ]);
        Reservable::factory()
            ->has(Salle::factory()->count(1))
            ->create([
                'numero' => 'S3',
                'etage' => 2,
                'capacite' => 10,
                'tarif' => 200,
            ]);
        $reservable = Reservable::factory()->create([
            'numero' => 'C1',
            'etage' => 2,
            'capacite' => 3,
            'tarif' => 20,
        ]);
        Chambre::create([
            'reservable_id' => $reservable->id
        ]);
        $reservable = Reservable::factory()->create([
            'numero' => 'C2',
            'etage' => 3,
            'capacite' => 4,
            'tarif' => 40,
        ]);
        Chambre::create([
            'reservable_id' => $reservable->id
        ]);
        $reservable = Reservable::factory()->create([
            'numero' => 'C3',
            'etage' => 4,
            'capacite' => 2,
            'tarif' => 35,
        ]);
        Chambre::create([
            'reservable_id' => $reservable->id
        ]);

        Avis::factory(15)->create();
        Service::factory(10)->create();
        Equippement::factory(20)->create();
        Categorie::factory(4)->create();
        Reservation::factory(4)->create();
        Facture::factory(6)->create();





    }
}
