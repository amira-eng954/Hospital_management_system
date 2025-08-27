<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class single_invoice extends Model
{
    //
  use HasFactory;
     protected $guarded=[];

     public function Section()
     { 
        return $this->belongsTo(Section::class,'section_id');

     }

      public function Patient()
     { 
        return $this->belongsTo(Patient::class,'patient_id');

     }

      public function Doctor()
     { 
        return $this->belongsTo(Doctor::class);

     }

      public function Service()
     { 
        return $this->belongsTo(Service::class,'Service_id');

     }
}


