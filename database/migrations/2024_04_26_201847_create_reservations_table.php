<?php

use App\Models\Client;
use App\Models\Reservable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->date('date_arrivee');
            $table->date('date_depart');
            $table->integer('adulte')->nullable();
            $table->integer('enfant')->nullable();
            $table->integer('nombre')->nullable();
            $table->string('status')->default('no paye');
            $table->foreignIdFor(Client::class, 'client_id')->nullable();
            $table->foreignIdFor(Reservable::class, 'reservable_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
