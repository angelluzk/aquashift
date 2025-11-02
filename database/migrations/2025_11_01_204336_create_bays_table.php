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
        Schema::create('bays', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira: todo box pertence a uma filial
            $table->foreignId('branch_id')
                  ->constrained('branches') // 'branches' é o nome da tabela
                  ->onDelete('cascade'); // Se a filial for deletada, os boxes tbm são

            $table->string('name'); // Ex: "Box 1", "Box Secagem 2"
            $table->string('type')->nullable(); // Ex: "Pequeno", "Grande", "Secagem"
            $table->boolean('is_active')->default(true); // Para desativar (manutenção)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bays');
    }
};
