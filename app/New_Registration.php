<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New_Registration extends Model
{

   protected $table = 'new_registration';

   protected $fillable = [
      'member_id',
      'salutation',
      'user_id',
      'f_name',
      'l_name',
      'm_name',
      'mother_name',
      'gender',
      'dob',
      'marital_status',
      'dom',
      'contact',
      'alt_contact',
      'tel',
      'email',
      'alt_email',
      'blood_group',
      'address',
      'city',
      'pincode',
      'alt_address',
      'alt_city',
      'alt_pincode',
      'khanp',
      'up_khanp',
      'occupation',
      'company_details',
      'qualification',
      'native_address',
      'dist',
      'native_pincode',
      'member_type',
      'member_code',
      'profile_photo'
      ];

      public function upkhanp()
    {
        return $this->belongsTo(UpKhanp::class, 'up_khanp');
    }

}
