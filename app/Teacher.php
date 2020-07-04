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
        return $this->hasMany('App\Schedule');
	}

	public function account()
	{
		return $this->belongsTo('App\User', 'teacher_id', 'username');
	}
}
