<?php

use App\Models\Facture;
use App\Models\Service;
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
        Schema::create('factures_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Facture::class, 'facture_id');
            $table->foreignIdFor(Service::class, 'service_id');
            $table->integer('nbre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures_services');
    }
};
