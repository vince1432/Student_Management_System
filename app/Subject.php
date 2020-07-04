<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable = ['name', 'unit'];

    public function grade()
    {
        return $this->hasOne('App\Grade');
	}

	public function students()
    {
        return $this->belongsToMany('App\Student');
	}

	public function schedules()
    {
        return $this->belongsToMany('App\Schedule');
	}

	public function courses()
    {
        return $this->belongsToMany('App\Course');
    }
}
