<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	use SoftDeletes;

	protected $fillable = ['student_id','first_name','last_name','birthday','address','contact_number','course_id'];

    public function course()
    {
        return $this->belongsTo('App\Course');
	}

	public function subjects()
    {
        return $this->belongsToMany('App\Subject');
	}

	public function account()
	{
		return $this->hasOne('App\User', 'username', 'student_id');
	}
}
