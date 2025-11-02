<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Converte as colunas de data/hora em objetos Carbon automaticamente.
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    /**
     * Um agendamento pertence a um cliente (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Um agendamento pertence a uma filial (Branch).
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Um agendamento pertence a um box (Bay).
     */
    public function bay()
    {
        return $this->belongsTo(Bay::class);
    }

    /**
     * Um agendamento é para um serviço (Service).
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}