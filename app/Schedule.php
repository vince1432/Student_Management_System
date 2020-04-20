<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
	}

	public function subjects()
    {
        return $this->belongsToMany('App\Subject');
	}

	public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }
}
