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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: "Lavagem Completa", "Enceramento"
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2); // Preço base (ex: 100.00)
            $table->integer('base_duration_minutes'); // Duração padrão (ex: 45 minutos)
            $table->boolean('is_active')->default(true); // Para desativar um serviço do menu
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
