<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $fillable = [
        'name','address','city','phone',
        'rating','specialization','is_verified'
    ];
}