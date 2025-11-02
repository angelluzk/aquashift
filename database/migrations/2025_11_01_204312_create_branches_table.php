<?php

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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: "AquaShift - Asa Sul"
            $table->string('address')->nullable();
            $table->string('contact_phone')->nullable();
            
            // Aqui usamos o poder do PostgreSQL: JSONB
            // Salva os horários de funcionamento
            // Ex: {"monday": ["08:00-12:00", "13:00-18:00"], "sunday": null}
            $table->jsonb('operating_hours')->nullable(); 

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
