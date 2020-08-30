<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'user_id','first_name','last_name',
        'birthday','gender','contact_number',
        'course_id','email',
		'building','barangay','city','province','other'
    ];

	protected static function boot()
    {
        parent::boot();

        static::created(function ($student){
            $student->account()->create([
                'userable_id' => $student->user_id,
                'password' => Hash::make($student->user_id),
                'role_id' => 1,
            ]);

            // Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
	}

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
		// return $this->hasOne('App\User', 'userable_id', 'user_id');
		return $this->morphOne('App\User','userable', null, null, 'user_id');
	}
}
