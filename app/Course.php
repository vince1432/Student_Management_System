<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = ['name'];

    public function course()
    {
        return $this->hasMany('App\Student');
	}

	public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }
}
