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
use App\Family;

class familycontroller extends Controller
{
    public function index()
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];

        $demo = DB::table('members')->get();
        $demo1 = DB::table('family')
                 ->join('members', 'members.id', '=', 'family.relation_member_id','left')
                 ->select('family.*', 'members.member_type','members.member_code','members.dob as member_dob','members.dom as member_dom','members.qualification as member_qualification','members.blood_group as member_blood_group')
                 ->where([
                    ['family.member_id', '=', $member_id]
                    ])
                 ->get();

        return view('user.family',compact('demo','demo1'));

    }

    public function get_family_info_member($id)
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.id', '=', $id]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $id;

        $member_name = $temp[0]['f_name']." ".$temp[0]['l_name'];

                 $demo1 = DB::table('family')
                 ->join('members', 'members.id', '=', 'family.relation_member_id','left')
                 ->select('family.*', 'members.member_type','members.member_code','members.dob as member_dob','members.dom as member_dom','members.qualification as member_qualification','members.blood_group as member_blood_group')
                 ->where([
                    ['family.member_id', '=', $member_id]
                    ])
                 ->get();

        return view('user.family_view_admins',compact('member_name','demo1'));
    }

    public function change($id)
    {

        $member_type = substr($id,0,2);
        $member_code = substr($id,2);

        $demo = DB::table('members')->where(['member_type'=>$member_type,'member_code'=>$member_code])->select('f_name','l_name')->get();


        foreach($demo as $d)
        {
            $fname = $d->f_name;
            $lname = $d->l_name;


            return $fname .' '.$lname;

        }

    }

    public function store(Request $request)
    {

        $member = $request->search_member;

        $member_type  = substr($member,0,2);
        $member_code = substr($member,2);


        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];
        $member_name = $temp[0]['f_name']." ".$temp[0]['l_name'];
        $member_dob = $temp[0]['dob'];
        $member_gender = $temp[0]['gender'];
        $member_dom = $temp[0]['dom'];
        $member_qualification = $temp[0]['qualification'];
        $member_blood_group = $temp[0]['blood_group'];

        $region_approval = "0";
        $region = Region::where('pincode', 'like', '%' . $temp[0]['pincode']. '%')->get();

        if(!$region)
        {
              $region_approval = "1";
        }

        $demo = DB::table('members')->where(['member_type'=>$member_type,'member_code'=>$member_code])->select('*')->get();

        foreach($demo as $val)
        {

            $id = $val->id;
            $name = $val->f_name." ".$val->l_name;
            $dob = $val->dob;
            $dom = $val->dom;
            $blood_group = $val->blood_group;
            $qualification = $val->qualification;

            $demo = DB::table('family')->insert(['member_id'=>$member_id,'relation_member_id'=>$id,'relation_name'=>$request->relation_name
                ,'relation_member_name'=>$name,'approval_status_regional'=>$region_approval]);

            $relation = "";

            if($request->relation_name == "Son" || $request->relation_name == "Daughter")
            {

                if($member_gender == "Male")
                {
                    $relation = "Father";   
                }
                else
                {
                    $relation = "Mother";   
                }

            }
            else if($request->relation_name == "Father" || $request->relation_name == "Mother")
            {
                if($member_gender == "Male")
                {
                    $relation = "Son";   
                }
                else
                {
                    $relation = "Daughter";   
                }
            }
            else if($request->relation_name == "Sister")
            {
                   $relation = "Brother";
            }
            else if($request->relation_name == "Brother")
            {
                   $relation = "Sister";
            }
            else if($request->relation_name == "Spouse")
            {
                   $relation = "Spouse";   
            }


            $demo = DB::table('family')->insert(['member_id'=>$id,'relation_member_id'=>$member_id,'relation_name'=>$relation
            ,'relation_member_name'=>$member_name]);

            Session::flash('success','insert Sucecssfully');
            return redirect('About_Family');

        }



    }

    public function approve_family_region_admin($id)
    {

        $demo = DB::table('family')->where('member_id',$id)->update([
            'approval_status_regional' => "1",
        ]);
        return redirect()->back();
    }

    public function approve_family_super_admin($id)
    {

        $demo = DB::table('family')->where('member_id',$id)->update([
            'approval_status_super_admin' => "1",
        ]);
        return redirect()->back();
    }

    public function get_family_region()
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();

        $temp = json_decode($temp, true);

        $id = $temp[0]['id'];

        $regions = DB::table('regions')
                 ->join('members', 'members.id', '=', 'regions.admin','left')
                 ->select('regions.id','regions.pincode','regions.name','regions.establishment_date',
                    'regions.members',
                    DB::raw('concat(members.f_name, " ", members.l_name) as admin_name'))
                ->where([
                ['regions.admin', '=', $id]
                ])
                 ->get();

                 // dd($regions);

        $regions = json_decode($regions, true);

        $output = array();
        $output1 = array();

        foreach ($regions as $key => $value)
        {

            if($value["members"] != "[]")
            {

                $members = json_decode($value["members"], true);

                $demo1 = DB::table('family')
                             ->join('members', 'members.id', '=', 'family.member_id')
                             ->select('members.id as member_id','members.f_name','members.l_name', 'members.member_type','members.member_code')
                             ->whereIn('family.member_id', $members)
                             ->distinct()
                             ->where([
                             ['family.approval_status_regional', '=', '0']
                             ])
                             ->get();

                foreach ($demo1 as $key1 => $value1)
                {
                    array_push($output,$value1);
                }

                $demo2 = DB::table('members')
                             ->select('members.id as member_id','members.f_name','members.l_name', 'members.member_type','members.member_code')
                             ->whereIn('members.id', $members)
                             ->distinct()
                             ->where([
                             ['members.member_update_regional', '!=', null]
                             ])
                             ->get();

                foreach ($demo2 as $key2 => $value2)
                {
                    array_push($output1,$value2);
                }

            }

        }

        return view('superadmin.member.update_approval',compact('output','output1'));

    }

    public function get_family_superadmin()
    {

        $output = array();

        $demo1 = DB::table('family')
                     ->join('members', 'members.id', '=', 'family.member_id')
                     ->select('members.id as member_id','members.f_name','members.l_name', 'members.member_type','members.member_code')
                     ->distinct()
                     ->where([
                     ['family.approval_status_regional', '=', '1'],
                     ['family.approval_status_super_admin', '=', '0']
                     ])
                     ->get();

        foreach ($demo1 as $key1 => $value1)
        {
            array_push($output,$value1);
        }

        $output1 = array();

        $demo2 = DB::table('members')
                     ->select('members.id as member_id','members.f_name','members.l_name', 'members.member_type','members.member_code')
                     ->distinct()
                     ->where([
                     ['members.member_update_regional', '=', null],
                     ['members.member_update_super_admin', '!=', null]
                     ])
                     ->get();

        foreach ($demo2 as $key2 => $value2)
        {
            array_push($output1,$value2);
        }

        return view('superadmin.member.update_approval',compact('output','output1'));

    }

    public function get_new_registration_regional()
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();

        $temp = json_decode($temp, true);

        $id = $temp[0]['id'];

        $output = array();

        $regions = DB::table('regions')
                 ->join('members', 'members.id', '=', 'regions.admin','left')
                 ->select('regions.id','regions.pincode','regions.name','regions.establishment_date',
                    'regions.members',
                    DB::raw('concat(members.f_name, " ", members.l_name) as admin_name'))
                ->where([
                ['regions.admin', '=', $id]
                ])
                 ->get();

                 foreach ($regions as $key => $value)
                 {

                     if($value->pincode != "")
                     {

                         $pincodes = explode(',',$value->pincode);

                         $demo2 = DB::table('new_registration')
                                      ->select('new_registration.*')
                                      ->whereIn('new_registration.pincode', $pincodes)
                                      ->distinct()
                                      ->where([
                                      ['new_registration.approve_regional', '=', 0]
                                      ])
                                      ->get();

                         foreach ($demo2 as $key1 => $value1)
                         {
                             array_push($output,$value1);
                         }

                     }

                 }

        return view('superadmin.member.registration_approval',compact('output','output1'));

    }

    public function get_new_registration_super_admin()
    {

        $output = array();

        $demo2 = DB::table('new_registration')
                     ->select('new_registration.*')
                     ->distinct()
                     ->where([
                     ['new_registration.approve_regional', '=', 1],
                     ['new_registration.approve_super_admin', '=', 0]
                     ])
                     ->get();

        foreach ($demo2 as $key1 => $value1)
        {
            array_push($output,$value1);
        }

        return view('superadmin.member.registration_approval',compact('output','output1'));

    }

        public function non_member_family_store(Request $request)
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];

        $region_approval = "0";
        $region = Region::where('pincode', 'like', '%' . $temp[0]['pincode']. '%')->get();

        if(!$region)
        {
              $region_approval = "1";
        }

        $demo = DB::table('family')->insert(['member_id'=>$member_id,'relation_name'=>$request->relation_name
            ,'relation_member_name'=>$request->name,'dob'=>$request->dob,'approval_status_regional'=>$region_approval,'dom'=>$request->dom,'qualification'=>$request->qualification,'blood_group'=>$request->blood_group]);

        Session::flash('success','insert Sucecssfully');
        return redirect('About_Family');


    }

 public function delete_family_member($id)
    {
      $family = Family::find($id);

        try
        {
           $family1 = Family::where('member_id', $family->relation_member_id)
                    ->where('relation_member_id', $family->member_id)
                    ->first();

           $family = Family::find($family1->id)->delete();   
        }
        catch(\Exception $e)
        {

        }
    
      Family::find($id)->delete();
      return redirect()->back();
    }


}
