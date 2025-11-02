<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * Desabilita a proteção de "mass assignment".
     * Vamos usar Form Requests para segurança mais tarde.
     */
    protected $guarded = [];

    /**
     * Converte o JSONB 'operating_hours' em um array PHP automaticamente.
     */
    protected $casts = [
        'operating_hours' => 'array',
    ];

    /**
     * Uma filial tem muitos boxes de lavagem.
     */
    public function bays()
    {
        return $this->hasMany(Bay::class);
    }

    /**
     * Uma filial tem muitos agendamentos.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}