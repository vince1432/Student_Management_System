<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
	use SoftDeletes;

	protected $fillable = ['teacher_id','first_name','last_name','birthday','address','contact_number'];
	// protected function boot()
	// {

	// }

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
		return $this->hasOne('App\User', 'username', 'teacher_id');
	}
}
