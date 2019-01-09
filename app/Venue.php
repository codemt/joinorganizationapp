<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{

	protected $table = 'venue';

    protected $fillable = [
    	'name','capacity','rent','contactperson','contactnumber','address','lat','lang','actual_address'
    ];
}
