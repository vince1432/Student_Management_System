<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'teacher_id','first_name',
        'last_name','birthday','gender',
		'contact_number', 'email',
		'building','barangay','city','province','other'
    ];

	protected static function boot()
    {
        parent::boot();

        static::created(function ($teacher){
            $teacher->account()->create([
                'username' => $teacher->teacher_id,
                'password' => Hash::make($teacher->teacher_id),
                'role_id' => 2,
            ]);
        });
    }

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
