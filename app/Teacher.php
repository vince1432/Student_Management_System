<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
	}

	public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }
}
