<?php

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
        Schema::create('equippements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ref');
            $table->foreignIdFor(Reservable::class,'reservable_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equippements');
    }
};
