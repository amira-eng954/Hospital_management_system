<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    
     public function doctor_app()
     {
        return $this->belongsToMany(Doctor::class);
     }

       public $fillable= ['name','email','phone','notes','doctor_id','section_id','type','appointment'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
