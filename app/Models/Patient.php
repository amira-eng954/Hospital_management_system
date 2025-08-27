<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //

    public $fillable= ['email','Password','Date_Birth','Phone','Gender','Blood_Group','name','address'];
}
