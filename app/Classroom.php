<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function schedule()
    {
        return $this->hasMany('App\Schedule');
    }
}
