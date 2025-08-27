<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    //


    public $fillable= ['car_number','car_model','car_year_made','driver_license_number','driver_phone','is_available','car_type','driver_name','notes'];
}
