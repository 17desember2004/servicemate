<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    /**
     * Kolom yang diizinkan untuk diisi massal.
     */
    protected $fillable = [
        'vehicle_id', 'service_type', 'service_date',
        'km_at_service', 'cost', 'bengkel_name', 'notes'
    ];

    /**
     * Hubungan balik: Satu catatan riwayat servis milik satu kendaraan.
     */
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
