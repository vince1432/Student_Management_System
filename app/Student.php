<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
	}

	public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }
}
