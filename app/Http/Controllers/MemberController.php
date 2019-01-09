<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use App\Member;
use App\User;
use App\Khanp;
use App\UpKhanp;
use App\Surname;
use Illuminate\Http\Request;
use App\Http\Requests\PhoneRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Region;
use App\Family;
use App\Qualification;
use App\Qualification_Category;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.member.index');
    }

    public function get_members()
    {
      $data = array();

        foreach (Member::all() as $key => $member) {
            array_push($data,array(
                $key,
                $member->l_name." ".$member->f_name,
                $member->contact,
                $member->gender,
                date("d/m/Y", strtotime($member->dob)),
                $member->member_type.$member->member_code,
                $member->pincode,
                $member->getRegion(),

                '<a href="'.route('member.edit',$member->id).'" class="btn btn-outline-success btn-xs edit" title="Edit Member" tooltip>
                    <i class="icon icon-edit"></i>
                </a>

                <button type="button" class="btn btn-xs btn-outline-danger delete" data-toggle="tooltip" data-id="'.$member->id.'" title="Delete Member">
                    <i class="icon icon-trash"></i>
                </button>'
            ));
        }

        return response()->json(['data' => $data]);
    }

    public function update_approval()
    {

        $family = DB::table('family')
                 ->join('members', 'members.id', '=', 'family.relation_member_id')
                 ->select('family.*', 'members.member_type','members.member_code')
                 ->where([
                    ['family.approval_status', '=', '0']
                    ])
                 ->get();

        return view('superadmin.member.update_approval',compact('family'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $members6 = Member::all();
        $surname = Surname::all();
        $region = Region::all();
        $qualification = Qualification::all();
        $qualification_category = Qualification_Category::all();

        return view('superadmin.member.create',compact('members','members6','surname','region','qualification','qualification_category'));
    }

    public function check_no()
    {
        $member_type =  DB::table('members')->where([
          ['contact','=',$request->contact]
          ]
          )->first();

      if($member_type)
      {
        return false;
      }
      else
      {
        return true;
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneRequest $request)
    {

      $validatedData = $request->validate([
        'mobile_no' => 'unique:members',

    ]);

    if(!$this->pincodeCheck($request->pincode)){
        Session::flash('error','Pincode not found in our database');
        return redirect()->back();
    }


    $imageName = "";

    if($request->file('profile_image') != null)
    {
        $imageName = 'Member_'.$request->contact.'.' .
        $request->file('profile_image')->getClientOriginalExtension();

        $imageName = 'img/'.$imageName;
    }

    try {

        $user = User::create([
                    'name' => $request->f_name.' '.$request->l_name,
                    'password' => Hash::make('123456'),
                    'email' => $request->email,
                    'phone' => $request->contact,
                    'role' => 1,
                    'image_url' => $imageName
                ]);

            if($request->file('profile_image') != null)
            {
                $imageName = 'Member_'.$request->contact.'.' .
                $request->file('profile_image')->getClientOriginalExtension();

                $request->file('profile_image')->move(
                    base_path() . '/public/img/', $imageName
                );

                $imageName = 'img/'.$imageName;
            }

        } catch (\Exception $e) {
            Session::flash('success','Phone is not unique');
            return redirect()->back();
        }

      $dob = null;

      if($request->dob != null)
      {
           $dob = Carbon::createFromFormat('d/m/Y', $request->dob);
      }

      $dom = null;

      if($request->dom != null)
      {
           $dom = Carbon::createFromFormat('d/m/Y', $request->dom);
      }

      $member_code = 0;
      $member_type =  DB::table('members')->where([
        ['member_type','=',$request->member_type]
        ]
        )->orderBy('id', 'desc')->first();

        // $member_type = json_decode($member_type);


        if($member_type)
        {
          $member_code = 1 + (int)$member_type->member_code;
        }
        else
        {
            $member_code = 1;
        }


    $member = Member::create ([
        'member_id'         => $request->member_id,
        'user_id'           => $user->id,
        'salutation'        => $request->salutation,
        'f_name'            => $request->f_name,
        'l_name'            => $request->l_name,
        'm_name'            => $request->m_name,
        'mother_name'       => $request->mother_name,
        'gender'            => $request->gender,
        'dob'               => $dob,
        'marital_status'    => $request->marital_status,
        'dom'               => $dom,
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
        'profile_photo'     => $imageName,
        'member_type'       => $request->member_type,
        'member_code'       => strval($member_code)
    ]);

    $regions = Region::all();

    foreach($regions as $region){
        if(isset($region->pincode)){
            $pincodes = explode(',',$region->pincode);
            if(in_array($request->pincode,$pincodes)){
                $members = json_decode($region->members) ?? [];
                array_push($members,strval($member->id));
                Region::find($region->id)->update([
                    'members' => json_encode($members,true),
                ]);
                break;
            }
    }
}

     Session::flash('success','New Member added');
     return redirect()->route('member.index');
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $members2 = Member::all();
        $members6 = Member::all();
        $surname = Surname::all();
        $region = Region::all();
        $qualification = Qualification::all();
        $qualification_category = Qualification_Category::all();

        return view('superadmin.member.edit',compact('member','members2' ,'members6','surname','region','qualification','qualification_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {

        $validatedData = $request->validate([
          'mobile_no' => 'unique:members',

        ]);

        if(!$this->pincodeCheck($request->pincode)){
            Session::flash('error','Pincode not found in our Regions');
            return redirect()->back();
        }

        $imageName = "";
        if($request->file('profile_image') != null)
        {
            $imageName = 'Member_'.$request->contact.'.' .
            $request->file('profile_image')->getClientOriginalExtension();

            $request->file('profile_image')->move(
                base_path() . '/public/img/', $imageName
            );

            $imageName = 'img/'.$imageName;
        }

        if($member->pincode != $request->pincode){
            $prev_region= Region::find($member->getRegionId());//get previous region of member
            $status = false;
            $regions = Region::all();
            foreach($regions as $region){
                if(isset($region->pincode)){
                    $pincodes = explode(',',$region->pincode);
                    if(in_array($request->pincode,$pincodes)){
                        $members = json_decode($region->members,true) ?? array();
                        array_push($members,strval($member->id));
                        Region::find($region->id)->update([
                            'members' => json_encode($members,true),
                        ]);
                        $status = true;
                        if($prev_region != null)
                        {
                            $prev_region_members = json_decode($prev_region->members);
                            $prev_region_members = array_diff($prev_region_members,[strval($member->id)]);
                            $prev_region->members = json_encode($prev_region_members);
                            $prev_region->save();
                        }
                        break;
                    }
            }

        }
        if(!$status){
            $request->pincode = $member->pincode;
        }
    }

        $member->member_id      = $request->member_id;
        $member->salutation     = $request->salutation;
        $member->f_name         = $request->f_name;
        $member->l_name         = $request->l_name;
        $member->m_name         = $request->m_name;
        $member->mother_name    = $request->mother_name;
        $member->gender         = $request->gender;
        if (strpos($request->dob, '/') !== false) {
            $member->dob            = Carbon::createFromFormat('d/m/Y', $request->dob);
        }
        if (strpos($request->dom, '/') !== false) {
            $member->dom            = Carbon::createFromFormat('d/m/Y', $request->dom);
        }
        $member->marital_status = $request->marital_status;
        $member->contact        = $request->contact;
        $member->alt_contact    = $request->alt_contact;
        $member->tel            = $request->tel;
        $member->email          = $request->email;
        $member->alt_email      = $request->alt_email;
        $member->blood_group    = $request->blood_group;
        $member->address        = $request->address;
        $member->city           = $request->city;
        $member->pincode        = $request->pincode;
        $member->alt_address    = $request->alt_address;
        $member->alt_city       = $request->alt_city;
        $member->alt_pincode    = $request->alt_pincode;
        $member->khanp          = $request->khanp;
        $member->up_khanp       = $request->up_khanp;
        $member->occupation     = $request->occupation;
        $member->company_details= $request->company_details;
        $member->qualification  = $request->qualification;
        $member->native_address = $request->native_address;
        $member->dist           = $request->dist;
        $member->native_pincode = $request->native_pincode;
        if($imageName != "")
        {
            $member->profile_photo  = $imageName;
        }
        $member->save();

        if($imageName != "")
        {
            $user  = User::findOrfail($request->user_id);

                $user->update([
                    'phone' =>  $request->contact,
                    'image_url' => $imageName
                ]);
        }
        else
        {
            $user  = User::findOrfail($request->user_id);

                $user->update([
                    'phone' =>  $request->contact
                ]);
        }





        Session::flash('success','Member updated');
        return redirect()->route('member.index');
    }

    public function update_password(Request $request)
    {
        $user  = User::findOrfail(Auth::user()["id"]);

            $user->update([
                'password' =>  Hash::make($request->password)
            ]);

        Session::flash('success','Password Updated Successfully');

        return redirect()->route('User_Profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return 'success';
    }
    public function getKhunpList($id)
    {
            $surname = Surname::find($id);
           $khanp = khanp::where('id',$surname->khanp_id)->get();
           $upkhanp = upkhanp::where('khanp_id',$surname->khanp_id)->get();
        return ['khanp' => $khanp,'upkhanp' =>$upkhanp
                 ];
    }

    public function getmembercode($member_type)
    {
        $member_code = 0;
        $member_types =  DB::table('members')->where([
          ['member_type','=',$member_type]
          ]
          )->orderBy('id', 'desc')->first();

          // $member_type = json_decode($member_type);


          if($member_types)
          {
            $member_code = 1 + (int)$member_types->member_code;
          }
          else
          {
              $member_code = 1;
          }

          return $member_type."".$member_code;
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


   

}
