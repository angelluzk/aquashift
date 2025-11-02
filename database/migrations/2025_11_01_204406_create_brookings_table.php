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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // QUEM (O Cliente)
            $table->foreignId('user_id')->constrained('users'); 
            
            // ONDE (A Filial e o Box alocado)
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('bay_id')->constrained('bays');
            
            // O QUÊ (O Serviço)
            $table->foreignId('service_id')->constrained('services');

            // QUANDO
            $table->dateTime('start_time'); // Início do agendamento
            $table->dateTime('end_time');   // Fim (calculado = start + duration + buffer)
            
            // VALORES
            $table->integer('duration_minutes'); // Duração final (pode incluir upsells)
            $table->decimal('total_price', 10, 2); // Preço final (pode incluir upsells)

            // STATUS (Nosso motor de fila dinâmica vai alterar isso)
            $table->string('status')->default('pending'); // pending, confirmed, in_progress, completed, cancelled, no_show

            $table->text('notes')->nullable(); // Notas do cliente ou do lavador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brookings');
    }
};
