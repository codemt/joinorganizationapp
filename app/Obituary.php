<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Obituary extends Model
{

    protected $fillable = [
        'photo',
        'member_id',
        'died_on',
        'obituary_date',
        'description',
        'birth_date',
        'description_one',
        'description_two',
        'description_three'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
