<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorie extends Model
{
    //

     protected $guarded=[];
     public function doctor()
     {
        return $this->belongsTo(Doctor::class);

     }
    

      public function  Patient()
     {
        return $this->belongsTo(Patient::class);

     }

     public function image()
     {
       return $this->morphMany(Image::class,'imageable');
     }


      public function employee()
     {
       return $this->belongsTo(LaboratorieEmployee::class);
     }

     
}
