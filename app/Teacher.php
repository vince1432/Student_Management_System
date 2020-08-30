<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'user_id','first_name',
        'last_name','birthday','gender',
		'contact_number', 'email',
		'building','barangay','city','province','other'
    ];

	protected static function boot()
    {
        parent::boot();

        static::created(function ($teacher){
            $teacher->account()->create([
                'userable_id' => $teacher->user_id,
                'password' => Hash::make($teacher->user_id),
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
		// return $this->hasOne('App\User', 'userable_id', 'user_id');
		return $this->morphOne('App\User','userable', null, null, 'user_id');
	}
}
