<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

	protected $table = 'event';

protected $fillable = [
	'name','regions','samiti','sponsorship','description','timing','featured_image','category','interested','venue_id'
];

	public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

}
