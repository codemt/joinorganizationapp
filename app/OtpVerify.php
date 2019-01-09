<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtpVerify extends Model
{
    protected $table = 'otp_verify';

    protected $fillable = [
        'phone','code'
    ];

}
