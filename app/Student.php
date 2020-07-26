<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'student_id','first_name','last_name',
        'birthday','address','contact_number',
        'course_id','email'
    ];

	protected static function boot()
    {
        parent::boot();

        static::created(function ($student){
            $student->account()->create([
                'username' => $student->student_id,
                'password' => Hash::make($student->student_id),
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
		return $this->hasOne('App\User', 'username', 'student_id');
	}
}
