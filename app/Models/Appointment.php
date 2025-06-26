<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

     protected $fillable = ['name'];

     public function doctor_app()
     {
        return $this->belongsToMany(Doctor::class);
     }
}
