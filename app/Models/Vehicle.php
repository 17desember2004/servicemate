<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id', 'name', 'brand', 'model',
        'year', 'plate_number', 'fuel_type', 'current_km', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function schedules() {
        return $this->hasMany(ServiceSchedule::class);
    }
    
    public function histories() {
        return $this->hasMany(ServiceHistory::class);
    }
    
    public function reminders() {
        return $this->hasMany(Reminder::class);
    }
}
