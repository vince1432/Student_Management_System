<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
	protected $fillable = ['prelim', 'midterm', 'prefinals', 'finals', 'average'];

	public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
