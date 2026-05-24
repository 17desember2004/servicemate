<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class ServiceSchedule extends Model
{
    protected $fillable = [
        'vehicle_id','service_type','due_date',
        'service_time','due_km','status','notes'
    ];
 
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
 