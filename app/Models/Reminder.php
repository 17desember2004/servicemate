<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    /**
     * Kolom yang diizinkan untuk diisi massal.
     */
    protected $fillable = [
        'user_id', 'vehicle_id', 'title', 'description',
        'remind_date', 'priority', 'is_read'
    ];

    /**
     * Hubungan balik: Satu pengingat milik satu kendaraan.
     */
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
