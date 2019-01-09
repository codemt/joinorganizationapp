<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\Member;
use App\User;
use App\Khanp;
use App\UpKhanp;
use App\Surname;
use App\Http\Requests\PhoneRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Region;
use App\Qualification;
use App\Qualification_Category;

class userprofilecontroller extends Controller
{
     public function index(Member $member)
    {
      $surname = Surname::all();
      $members2 = Member::all();
      $members6 = Member::all();
      $id = Auth::user()->id;
      $qualification = Qualification::all();
      $qualification_category = Qualification_Category::all();
         $demo  = DB::table('members')->where('user_id',$id)->get();

        if($demo[0]->member_update_super_admin !=null)
        {

            $temp = json_decode($demo[0]->member_update_super_admin,true);


            $demo[0]->user_id           =  $temp['user_id'];


            $demo[0]->salutation        =  $temp['salutation'];
            $demo[0]->f_name            =  $temp['f_name'];
            $demo[0]->m_name            =  $temp['m_name'];
            $demo[0]->mother_name       =  $temp['mother_name'];
            $demo[0]->gender            =  $temp['gender'];
            $demo[0]->dob               =  $temp['dob'];
            $demo[0]->marital_status    =  $temp['marital_status'];
            $demo[0]->dom               =  $temp['dom'];
            $demo[0]->contact           =  $temp['contact'];
            $demo[0]->alt_contact       =  $temp['alt_contact'];
            $demo[0]->tel               =  $temp['tel'];
            $demo[0]->email             =  $temp['email'];
            $demo[0]->alt_email         =  $temp['alt_email'];
            $demo[0]->blood_group       =  $temp['blood_group'];
            $demo[0]->address           =  $temp['address'];
            $demo[0]->city              =  $temp['city'];
            $demo[0]->up_khanp          =  $temp['up_khanp'];
            $demo[0]->alt_address       =  $temp['alt_address'];
            $demo[0]->alt_city          =  $temp['alt_city'];
            $demo[0]->alt_pincode       =  $temp['alt_pincode'];
            $demo[0]->occupation        =  $temp['occupation'];
            $demo[0]->company_details   =  $temp['company_details'];
            $demo[0]->qualification     =  $temp['qualification'];
            $demo[0]->native_address    =  $temp['native_address'];
            $demo[0]->dist              =  $temp['dist'];
            $demo[0]->native_pincode    =  $temp['native_pincode'];
            if(isset($temp['profile_photo']))
            {
                $demo[0]->profile_photo     =  $temp['profile_photo'];
            }

        }

        return view('user.profile',['member'=>$demo[0],'surname'=>$surname,'members2'=>$members2,'qualification'=>$qualification,'members6'=>$members6,'qualification_category'=>$qualification_category]);
       // return view('user.profile',compact('member','members2' ,'members6','surname'));
    }

    public function user_profile_view($id)
   {
       $surname = Surname::all();
       $members2 = Member::all();
       $members6 = Member::all();
       $qualification = Qualification::all();
       $demo  = DB::table('members')->where('id',$id)->get();

       if($demo[0]->member_update_super_admin !=null)
       {

           $temp = json_decode($demo[0]->member_update_super_admin,true);


           $demo[0]->user_id           =  $temp['user_id'];


           $demo[0]->salutation        =  $temp['salutation'];
           $demo[0]->f_name            =  $temp['f_name'];
           $demo[0]->m_name            =  $temp['m_name'];
           $demo[0]->mother_name       =  $temp['mother_name'];
           $demo[0]->gender            =  $temp['gender'];
           $demo[0]->dob               =  $temp['dob'];
           $demo[0]->marital_status    =  $temp['marital_status'];
           $demo[0]->dom               =  $temp['dom'];
           $demo[0]->contact           =  $temp['contact'];
           $demo[0]->alt_contact       =  $temp['alt_contact'];
           $demo[0]->tel               =  $temp['tel'];
           $demo[0]->email             =  $temp['email'];
           $demo[0]->alt_email         =  $temp['alt_email'];
           $demo[0]->blood_group       =  $temp['blood_group'];
           $demo[0]->address           =  $temp['address'];
           $demo[0]->city              =  $temp['city'];
           $demo[0]->up_khanp          =  $temp['up_khanp'];
           $demo[0]->alt_address       =  $temp['alt_address'];
           $demo[0]->alt_city          =  $temp['alt_city'];
           $demo[0]->alt_pincode       =  $temp['alt_pincode'];
           $demo[0]->occupation        =  $temp['occupation'];
           $demo[0]->company_details   =  $temp['company_details'];
           $demo[0]->qualification     =  $temp['qualification'];
           $demo[0]->native_address    =  $temp['native_address'];
           $demo[0]->dist              =  $temp['dist'];
           $demo[0]->native_pincode    =  $temp['native_pincode'];
           if(isset($temp['profile_photo']))
           {
               $demo[0]->profile_photo     =  $temp['profile_photo'];
           }


       }

       return view('superadmin.member.view_update',['member'=>$demo[0],'surname'=>$surname,'qualification'=>$qualification,'members2'=>$members2,'members6'=>$members6]);
      // return view('user.profile',compact('member','members2' ,'members6','surname'));
   }


   public function registration_profile_view($id)
  {
      $surname = Surname::all();
      $members2 = Member::all();
      $members6 = Member::all();
      $qualification = Qualification::all();
      $demo  = DB::table('new_registration')->where('id',$id)->get();

      return view('superadmin.member.new_registration',['member'=>$demo[0],'surname'=>$surname,'members2'=>$members2,'qualification'=>$qualification,'members6'=>$members6]);

  }

    public function update(Request $request)
    {

        if($request->password != null && $request->password != '')
        {
            $db = DB::table('users')->where('id',$request->user_id)->update([
                'password' =>  Hash::make($request->password)
            ]);
        }

        $imageName = "";
        if($request->file('profile_image') != null)
        {
            $imageName = 'Member_'.rand().$request->contact.'.' .
            $request->file('profile_image')->getClientOriginalExtension();

            $request->file('profile_image')->move(
                base_path() . '/public/img/', $imageName
            );

            $imageName = 'img/'.$imageName;

            $data = array(
            'user_id'           => $request->user_id,
            'salutation'        => $request->salutation,
            'f_name'            => $request->f_name,
            'm_name'            => $request->m_name,
            'mother_name'       => $request->mother_name,
            'gender'            => $request->gender,
            'dob'               => $request->dob,
            'marital_status'    => $request->marital_status,
            'dom'               => $request->dom,
            'contact'           => $request->contact,
            'alt_contact'       => $request->alt_contact,
            'tel'               => $request->tel,
            'email'             => $request->email,
            'alt_email'         => $request->alt_email,
            'blood_group'       => $request->blood_group,
            'address'           => $request->address,
            'city'              => $request->city,
            'up_khanp'          => $request->up_khanp,
            'alt_address'       => $request->alt_address,
            'alt_city'          => $request->alt_city,
            'alt_pincode'       => $request->alt_pincode,
            'occupation'        => $request->occupation,
            'company_details'   => $request->company_details,
            'qualification'     => $request->qualification,
            'native_address'    => $request->native_address,
            'dist'              => $request->dist,
            'native_pincode'    => $request->native_pincode,
            'profile_photo'     => $imageName,
            );
        }
        else {
            $data = array(
            'user_id'           => $request->user_id,
            'salutation'        => $request->salutation,
            'f_name'            => $request->f_name,
            'm_name'            => $request->m_name,
            'mother_name'       => $request->mother_name,
            'gender'            => $request->gender,
            'dob'               => $request->dob,
            'marital_status'    => $request->marital_status,
            'dom'               => $request->dom,
            'contact'           => $request->contact,
            'alt_contact'       => $request->alt_contact,
            'tel'               => $request->tel,
            'email'             => $request->email,
            'alt_email'         => $request->alt_email,
            'blood_group'       => $request->blood_group,
            'address'           => $request->address,
            'city'              => $request->city,
            'up_khanp'          => $request->up_khanp,
            'alt_address'       => $request->alt_address,
            'alt_city'          => $request->alt_city,
            'alt_pincode'       => $request->alt_pincode,
            'occupation'        => $request->occupation,
            'company_details'   => $request->company_details,
            'qualification'     => $request->qualification,
            'native_address'    => $request->native_address,
            'dist'              => $request->dist,
            'native_pincode'    => $request->native_pincode,
            );
        }



        $member_update_regional = json_encode($data);

        $demo  = DB::table('members')->where('id',$request->id)->get();

        $region = Region::where('pincode', 'like', '%' . $demo[0]->pincode. '%')->get();

        if(!$region)
        {
              $member_update_regional = null;
        }

        $demo = DB::table('members')->where('id',$request->id)->update([
            'member_update_regional'     => $member_update_regional,
            'member_update_super_admin'  => json_encode($data)
        ]);

        Session::flash('success','Member updated');
        return redirect()->route('User_Profile');

    }

    public function approve_update_region_admin($id)
    {

        $demo = DB::table('members')->where('id',$id)->update([
            'member_update_regional' => null,
        ]);
        return redirect()->back();

    }

    public function approve_registration_superadmin_bulk(Request $request)
    {
        foreach($request->id as $val)
        {
            $this->approve_registration_super_admin_internal($val);
        }

        return ['status' => true];

    }

    public function approve_registration_regional_bulk(Request $request)
    {

        $demo = DB::table('new_registration')->whereIn('id',$request->id)->update([
            'approve_regional' => 1,
        ]);

        return ['status' => true];

    }

        public function approve_member_regional_bulk(Request $request)
    {

        foreach($request->update_type as $key => $val)
        {

            if($val == "Family Update")
            {
                $demo = DB::table('family')->where('member_id',$request->member_id[$key])->update([
                    'approval_status_regional' => "1",
                ]);
            }
            else
            {
                $demo = DB::table('members')->where('id',$request->member_id[$key])->update([
                    'member_update_regional' => null,
                ]);
            }

        }

        return ['status' => true];
    }

    public function approve_member_superadmin_bulk(Request $request)
    {

        foreach($request->update_type as $key => $val)
        {

            if($val == "Family Update")
            {
                $demo = DB::table('family')->where('member_id',$request->member_id[$key])->update([
                    'approval_status_super_admin' => "1",
                ]);
            }
            else
            {

                $this->approve_update_super_admin_internal($request->member_id[$key]);

            }

        }

        return ['status' => true];
    }

    public function approve_update_super_admin($id)
    {

        $demo  = DB::table('members')->where('id',$id)->get();

        $temp = json_decode($demo[0]->member_update_super_admin,true);

        $dob = null; 

      if($temp['dob'] != null)
      {
         if(strpos($temp['dob'], '-') !== false)
         {
           $dob = Carbon::createFromFormat('Y-m-d', $temp['dob']);
         }
         else
         {
           $dob = Carbon::createFromFormat('d/m/Y', $temp['dob']);
         }
      }

      $dom = null;

      if($temp['dom'] != null)
      {
         if(strpos($temp['dom'], '-') !== false)
         {
           $dom = Carbon::createFromFormat('Y-m-d', $temp['dom']);
         }
         else
         {
           $dom = Carbon::createFromFormat('d/m/Y', $temp['dom']);
         }
      }

      if(isset($temp['profile_photo']))
      {
          $demo = DB::table('members')->where('id',$id)->update([

          'user_id'           => $temp['user_id'],
          'salutation'        => $temp['salutation'],
          'f_name'            => $temp['f_name'],
          'm_name'            => $temp['m_name'],
          'mother_name'       => $temp['mother_name'],
          'gender'            => $temp['gender'],
          'dob'               => $dob,
          'marital_status'    => $temp['marital_status'],
          'dom'               => $dom,
          'contact'           => $temp['contact'],
          'alt_contact'       => $temp['alt_contact'],
          'tel'               => $temp['tel'],
          'email'             => $temp['email'],
          'alt_email'         => $temp['alt_email'],
          'blood_group'       => $temp['blood_group'],
          'address'           => $temp['address'],
          'city'              => $temp['city'],
          'up_khanp'          => $temp['up_khanp'],
          'alt_address'       => $temp['alt_address'],
          'alt_city'          => $temp['alt_city'],
          'alt_pincode'       => $temp['alt_pincode'],
          'occupation'        => $temp['occupation'],
          'company_details'   => $temp['company_details'],
          'qualification'     => $temp['qualification'],
          'native_address'    => $temp['native_address'],
          'dist'              => $temp['dist'],
          'native_pincode'    => $temp['native_pincode'],
          'profile_photo'     => $temp['profile_photo'],
          ]);

          $user  = User::findOrfail($temp['user_id']);

             $user->update([
                 'phone' =>  $temp['contact'],
                 'image_url' => $temp['profile_photo']
             ]);
      }
      else
      {
          $demo = DB::table('members')->where('id',$id)->update([

          'user_id'           => $temp['user_id'],
          'salutation'        => $temp['salutation'],
          'f_name'            => $temp['f_name'],
          'm_name'            => $temp['m_name'],
          'mother_name'       => $temp['mother_name'],
          'gender'            => $temp['gender'],
          'dob'               => $dob,
          'marital_status'    => $temp['marital_status'],
          'dom'               => $dom,
          'contact'           => $temp['contact'],
          'alt_contact'       => $temp['alt_contact'],
          'tel'               => $temp['tel'],
          'email'             => $temp['email'],
          'alt_email'         => $temp['alt_email'],
          'blood_group'       => $temp['blood_group'],
          'address'           => $temp['address'],
          'city'              => $temp['city'],
          'up_khanp'          => $temp['up_khanp'],
          'alt_address'       => $temp['alt_address'],
          'alt_city'          => $temp['alt_city'],
          'alt_pincode'       => $temp['alt_pincode'],
          'occupation'        => $temp['occupation'],
          'company_details'   => $temp['company_details'],
          'qualification'     => $temp['qualification'],
          'native_address'    => $temp['native_address'],
          'dist'              => $temp['dist'],
          'native_pincode'    => $temp['native_pincode'],
          ]);

          $user  = User::findOrfail($temp['user_id']);

             $user->update([
                 'phone' =>  $temp['contact']
             ]);
      }





        $demo = DB::table('members')->where('id',$id)->update([
            'member_update_super_admin' => null,
        ]);

        Session::flash('success','Member updated');
        return redirect()->route('get_family_superadmin');


    }

    public function approve_registration_regional_admin($id)
    {

        $demo = DB::table('new_registration')->where('id',$id)->update([
            'approve_regional' => 1,
        ]);
        return redirect()->back();

    }

    public function approve_registration_super_admin($id)
    {

        $demo  = DB::table('new_registration')->where('id',$id)->get();

        $request = $demo[0];

      $member_code = 0;
      $member_type =  DB::table('members')->where([
        ['member_type','=',$request->member_type]
      ]
        )->orderBy('id', 'desc')->first();

      if($member_type)
      {
        $member_code = 1 + (int)$member_type->member_code;
      }
      else
      {
        $member_code = 1;
      }

        $user = User::create([
                    'name' => $request->f_name.' '.$request->l_name,
                    'password' => Hash::make('123456'),
                    'email' => $request->email,
                    'phone' => $request->contact,
                    'role' => 1,
                    'image_url' => $request->profile_photo
                ]);

        $member = Member::create ([
            'user_id'           => $user->id,
            'member_id'         => $request->member_id,
            'salutation'        => $request->salutation,
            'f_name'            => $request->f_name,
            'l_name'            => $request->l_name,
            'm_name'            => $request->m_name,
            'mother_name'       => $request->mother_name,
            'gender'            => $request->gender,
            'dob'               => $request->dob,
            'marital_status'    => $request->marital_status,
            'dom'               => $request->dom,
            'contact'           => $request->contact,
            'alt_contact'       => $request->alt_contact,
            'tel'               => $request->tel,
            'email'             => $request->email,
            'alt_email'         => $request->alt_email,
            'blood_group'       => $request->blood_group,
            'address'           => $request->address,
            'city'              => $request->city,
            'pincode'           => $request->pincode,
            'alt_address'       => $request->alt_address,
            'alt_city'          => $request->alt_city,
            'alt_pincode'       => $request->alt_pincode,
            'khanp'             => $request->khanp,
            'up_khanp'          => $request->up_khanp,
            'occupation'        => $request->occupation,
            'company_details'   => $request->company_details,
            'qualification'     => $request->qualification,
            'native_address'    => $request->native_address,
            'dist'              => $request->dist,
            'native_pincode'    => $request->native_pincode,
            'profile_photo'     => $request->profile_photo,
            'member_type'       => $request->member_type,
            'member_code'       => strval($member_code)
        ]);

        $regions = Region::all();

        foreach($regions as $region)
        {
          if(isset($region->pincode))
            {
            $pincodes = explode(',',$region->pincode);
            if(in_array($request->pincode,$pincodes))
                {
              $members = json_decode($region->members) ?? [];
              array_push($members,strval($member->id));
              Region::find($region->id)->update([
                'members' => json_encode($members,true),
              ]);
              break;
            }
          }
        }

        $demo = DB::table('new_registration')->where('id',$id)->update([
            'approve_super_admin' => 1,
        ]);
        return redirect()->back();

    }

    public function pincodeCheck($pincode){
        $regions = Region::all();
        $status = false;
        foreach($regions as $region){
            if(isset($region->pincode)){
                $pincodes = explode(',',$region->pincode);
                if(in_array($pincode,$pincodes)){
                    $status = true;
                    break;
                }
        }
    }
    return $status;
    }

        public function approve_update_super_admin_internal($id)
    {

        $demo  = DB::table('members')->where('id',$id)->get();

        $temp = json_decode($demo[0]->member_update_super_admin,true);

        $dob = null;

      if($temp['dob'] != null)
      {
         if(strpos($temp['dob'], '-') !== false)
         {
           $dob = Carbon::createFromFormat('Y-m-d', $temp['dob']);
         }
         else
         {
           $dob = Carbon::createFromFormat('d/m/Y', $temp['dob']);
         }
      }

      $dom = null;

      if($temp['dom'] != null)
      {
         if(strpos($temp['dom'], '-') !== false)
         {
           $dom = Carbon::createFromFormat('Y-m-d', $temp['dom']);
         }
         else
         {
           $dom = Carbon::createFromFormat('d/m/Y', $temp['dom']);
         }
      }

      if(isset($temp['profile_photo']))
      {
          $demo = DB::table('members')->where('id',$id)->update([

          'user_id'           => $temp['user_id'],
          'salutation'        => $temp['salutation'],
          'f_name'            => $temp['f_name'],
          'm_name'            => $temp['m_name'],
          'mother_name'       => $temp['mother_name'],
          'gender'            => $temp['gender'],
          'dob'               => $dob,
          'marital_status'    => $temp['marital_status'],
          'dom'               => $dom,
          'contact'           => $temp['contact'],
          'alt_contact'       => $temp['alt_contact'],
          'tel'               => $temp['tel'],
          'email'             => $temp['email'],
          'alt_email'         => $temp['alt_email'],
          'blood_group'       => $temp['blood_group'],
          'address'           => $temp['address'],
          'city'              => $temp['city'],
          'up_khanp'          => $temp['up_khanp'],
          'alt_address'       => $temp['alt_address'],
          'alt_city'          => $temp['alt_city'],
          'alt_pincode'       => $temp['alt_pincode'],
          'occupation'        => $temp['occupation'],
          'company_details'   => $temp['company_details'],
          'qualification'     => $temp['qualification'],
          'native_address'    => $temp['native_address'],
          'dist'              => $temp['dist'],
          'native_pincode'    => $temp['native_pincode'],
          'profile_photo'     => $temp['profile_photo'],
          ]);

          $user  = User::findOrfail($temp['user_id']);

             $user->update([
                 'phone' =>  $temp['contact'],
                 'image_url' => $temp['profile_photo']
             ]);
      }
      else
      {
          $demo = DB::table('members')->where('id',$id)->update([

          'user_id'           => $temp['user_id'],
          'salutation'        => $temp['salutation'],
          'f_name'            => $temp['f_name'],
          'm_name'            => $temp['m_name'],
          'mother_name'       => $temp['mother_name'],
          'gender'            => $temp['gender'],
          'dob'               => $dob,
          'marital_status'    => $temp['marital_status'],
          'dom'               => $dom,
          'contact'           => $temp['contact'],
          'alt_contact'       => $temp['alt_contact'],
          'tel'               => $temp['tel'],
          'email'             => $temp['email'],
          'alt_email'         => $temp['alt_email'],
          'blood_group'       => $temp['blood_group'],
          'address'           => $temp['address'],
          'city'              => $temp['city'],
          'up_khanp'          => $temp['up_khanp'],
          'alt_address'       => $temp['alt_address'],
          'alt_city'          => $temp['alt_city'],
          'alt_pincode'       => $temp['alt_pincode'],
          'occupation'        => $temp['occupation'],
          'company_details'   => $temp['company_details'],
          'qualification'     => $temp['qualification'],
          'native_address'    => $temp['native_address'],
          'dist'              => $temp['dist'],
          'native_pincode'    => $temp['native_pincode'],
          ]);

          $user  = User::findOrfail($temp['user_id']);

             $user->update([
                 'phone' =>  $temp['contact']
             ]);
      }





        $demo = DB::table('members')->where('id',$id)->update([
            'member_update_super_admin' => null,
        ]);

        return;


    }

        public function approve_registration_super_admin_internal($id)
    {

        $demo  = DB::table('new_registration')->where('id',$id)->get();

        $request = $demo[0];

        $member_code = 0;
        $member_type =  DB::table('members')->where([
            ['member_type','=',$request->member_type]
        ]
        )->orderBy('id', 'desc')->first();

        if($member_type)
        {
            $member_code = 1 + (int)$member_type->member_code;
        }
        else
        {
            $member_code = 1;
        }

        $user = User::create([
                    'name' => $request->f_name.' '.$request->l_name,
                    'password' => Hash::make('123456'),
                    'email' => $request->email,
                    'phone' => $request->contact,
                    'role' => 1,
                    'image_url' => $request->profile_photo
                ]);

        $member = Member::create ([
            'user_id'           => $user->id,
            'member_id'         => $request->member_id,
            'salutation'        => $request->salutation,
            'f_name'            => $request->f_name,
            'l_name'            => $request->l_name,
            'm_name'            => $request->m_name,
            'mother_name'       => $request->mother_name,
            'gender'            => $request->gender,
            'dob'               => $request->dob,
            'marital_status'    => $request->marital_status,
            'dom'               => $request->dom,
            'contact'           => $request->contact,
            'alt_contact'       => $request->alt_contact,
            'tel'               => $request->tel,
            'email'             => $request->email,
            'alt_email'         => $request->alt_email,
            'blood_group'       => $request->blood_group,
            'address'           => $request->address,
            'city'              => $request->city,
            'pincode'           => $request->pincode,
            'alt_address'       => $request->alt_address,
            'alt_city'          => $request->alt_city,
            'alt_pincode'       => $request->alt_pincode,
            'khanp'             => $request->khanp,
            'up_khanp'          => $request->up_khanp,
            'occupation'        => $request->occupation,
            'company_details'   => $request->company_details,
            'qualification'     => $request->qualification,
            'native_address'    => $request->native_address,
            'dist'              => $request->dist,
            'native_pincode'    => $request->native_pincode,
            'profile_photo'     => $request->profile_photo,
            'member_type'       => $request->member_type,
            'member_code'       => strval($member_code)
        ]);

        $regions = Region::all();

        foreach($regions as $region)
        {
            if(isset($region->pincode))
            {
                $pincodes = explode(',',$region->pincode);
                if(in_array($request->pincode,$pincodes))
                {
                    $members = json_decode($region->members) ?? [];
                    array_push($members,strval($member->id));
                    Region::find($region->id)->update([
                        'members' => json_encode($members,true),
                    ]);
                    break;
                }
            }
        }

        $demo = DB::table('new_registration')->where('id',$id)->update([
            'approve_super_admin' => 1,
        ]);
        return;
    }


}
