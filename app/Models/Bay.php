<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Um box pertence a uma filial.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Um box pode ter muitos agendamentos.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}