<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    //
     protected $guarded=[];
     public function doctor()
     {
        return $this->belongsTo(Doctor::class);

     }

     public function employee()
     {  
       return $this->belongsTo(RayEmployee::class);

     }
      public function patient()
     {  
       return $this->belongsTo(Patient::class);

     }

     public function image()
     {
       return $this->morphMany(Image::class,'imageable');
     }
}
