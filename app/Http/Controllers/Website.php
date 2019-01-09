<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Event;
use App\User;
use App\OtpVerify;
use App\Member;
use App\Khanp;
use App\UpKhanp;
use App\Surname;
use App\Region;
use App\New_Registration;
use Illuminate\Support\Facades\DB;
use App\Brochure;
use Storage;
use Response;
use Ixudra\Curl\Facades\Curl;

use App\Http\Requests\PhoneRequest;
use App\Qualification;
use App\Qualification_Category;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Excel;

class Website extends Controller
{
	public function gallery() {
		$gallery = Gallery::all();
		return view('www.gallery',compact('gallery'));
	}

	public function showGallery($id) {
		$gallery = Gallery::find($id);
		$images = json_decode($gallery->images,true);
		return view('www.gallery-details',compact('gallery','images'));
	}

	public function events() {
		$event = DB::table('event')
		->join('venue', 'venue.id', '=', 'event.venue_id')
		->select('event.*','venue.name as venue_name','venue.actual_address as venue_address')
		->get();

		$event = json_decode($event, true);
		foreach ($event as $key => $value) {
			$interested = json_decode($value["interested"], true);
			foreach ($interested as $key1 => $value1) {
				$user = DB::table('members')
				->select('members.*')
				->where([
					['members.id', '=', $value1]
				])
				->get();
				$user = json_decode($user, true);
				$event[$key]["members_array"][$key1] = $user[0]['f_name']." ".$user[0]['l_name'];
			}
		}
		return view('www.events',compact('event'));
	}


	public function showBrochures(){

		$brochures = Brochure::all();

		return view('www.saraswani',compact('brochures'));
	}

	public function viewBrochure($id){

		$brochure = Brochure::find($id);

		return Storage::response($brochure->file);

    }

	public function eventDetails($id) {

		$events = DB::table('event')
             ->join('venue', 'venue.id', '=', 'event.venue_id')
             ->select('event.*','venue.name as venue_name','venue.actual_address as venue_address','venue.lat as lat','venue.lang as lang')
             ->where([
                 ['event.id','=',$id]
             ])
             ->get();

           $temp = json_decode($events, true);

           $events = $temp[0];

         $samiti = json_decode($events["samiti"], true);
			$events["samiti_array"] = array();
          foreach ($samiti as $key2 => $value2) {

                        $user = DB::table('samiti')
                                 ->select('samiti.*')
                                 ->where([
                                 ['samiti.id', '=', $value2]
                                 ])
                                 ->get();

                        $user = json_decode($user, true);

                if(isset($user[0]))
                {
	                $events["samiti_array"][$key2] = $user[0]['name'];
                }

            }

		return view('www.event-details',compact('events'));
	}

	public function get_obituary()
	{
		$obituary = DB::select("SELECT *,concat(members.f_name, ' ', members.l_name) as member_name
					FROM obituaries
					INNER JOIN members ON members.id=obituaries.member_id
					WHERE obituaries.died_on < NOW()
					ORDER BY obituaries.died_on DESC
					LIMIT 5 ");

		return view('www.orbituary',compact('obituary'));
	}

	public function sendOtp(Request $request)
	{

	$code=rand(999,9999);
	$phone=$request->phone;

	$exist = User::where('phone',$phone)->first();

	if($exist==null){
		return ["not_present" => true];
	}

	OtpVerify::where('phone',$phone)->delete();

	$otp = new OtpVerify;
	$otp->phone=$phone;
	$otp->code=$code;
	$otp->save();


	 $url="http://smsservice.fourbrothers.co.in/http-api.php?username=suboffice&password=123456&senderid=SUBOFF&route=1&number=91".$phone."&message=".$code."%20is%20your%20one%20time%20password%20for%20login%20verification%20for%20Syndicate%20App";
	  $response = Curl::to($url)->get();
	return ["success" => $response];
	}

	public function member_registeration() {
		$members = Member::all();
		$members6 = Member::all();
		$surname = Surname::all();
		$region = Region::all();
    	$qualification = Qualification::all();
        $qualification_category = Qualification_Category::all();

		return view('www.member-registeration',compact('members','members6','surname','region','qualification','qualification_category'));
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

	public function getKhunpList($id)
    {

	    $surname = Surname::where('name',$id)->first();
        $khanp = khanp::where('id',$surname->khanp_id)->get();
        $upkhanp = upkhanp::where('khanp_id',$surname->khanp_id)->get();
        return ['khanp' => $khanp,'upkhanp' =>$upkhanp];
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

	public function member_register(Request $request){
		//dd($request->all());

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

			$request->file('profile_image')->move(
				base_path() . '/public/img/', $imageName
			);

			$imageName = 'img/'.$imageName;
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

	// 	$member_code = 0;
	// 	$member_type =  DB::table('members')->where([
	// 		['member_type','=',$request->member_type]
	// 	]
	// )->orderBy('id', 'desc')->first();
	//
	// 	if($member_type)
	// 	{
	// 		$member_code = 1 + (int)$member_type->member_code;
	// 	}
	// 	else
	// 	{
	// 		$member_code = 1;
	// 	}



		$member = New_Registration::create ([
			'member_id'         => $request->member_id,
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
		]);

		// $regions = Region::all();

		// foreach($regions as $region){
		// 	if(isset($region->pincode)){
		// 		$pincodes = explode(',',$region->pincode);
		// 		if(in_array($request->pincode,$pincodes)){
		// 			$members = json_decode($region->members) ?? [];
		// 			array_push($members,strval($member->id));
		// 			Region::find($region->id)->update([
		// 				'members' => json_encode($members,true),
		// 			]);
		// 			break;
		// 		}
		// 	}
		// }

		Session::flash('success','New Member added');
		return redirect()->route('member-registeration');


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

        public function importExcel(Request $request)
	{

	    if($request->hasFile('import_file')){


	        $path = $request->file('import_file')->getRealPath();
	        $data = Excel::load($path, function($reader) {})->get();

	        if(!empty($data) && $data->count()){

	            foreach ($data->toArray()[0] as $key => $value) {

					// print_r($value);die();
					// if(!isset($value[0]))
					// {
					// 	dd($value);
					// }
					// $value = $value[0];

	                if(!empty($value)){

                                  $exist = User::where('phone',$value['member_primary_mobile_no.'])->first();
                                if($exist)
                                {
                                	$user = User::create([
					                    'name' => $value['member_first_name'].' '.$value['member_last_name'],
					                    'email' => $value['member_primary_email_id'],
					                    'password' => Hash::make('123456'),
                    					'role' => 1,
					                    'image_url' => ''
					                ]);
                                }
                                else
                                {
                                	$user = User::create([
					                    'name' => $value['member_first_name'].' '.$value['member_last_name'],
					                    'email' => $value['member_primary_email_id'],
					                    'phone' => $value['member_primary_mobile_no.'],
					                    'password' => Hash::make('123456'),
                    					'role' => 1,
					                    'image_url' => ''
					                ]);
                                }





					                $dob = null;

								      if($value['member_date_of_birth'] != null)
								      {
								           $dob = Carbon::parse($value['member_date_of_birth'])->format('d-m-Y  h:i:s A');
						                   $dob = Carbon::createFromFormat('d-m-Y  h:i:s A', $dob);
								      }

	                              $member = Member::create ([
								        'user_id'           => $user->id,
								        'salutation'        => '',
								        'f_name'            => $value['member_first_name'],
								        'l_name'            => $value['member_last_name'],
								        'm_name'            => $value['member_middle_name'],
								        'gender'            => $value['member_gender'],
								        'dob'               => $dob,
								        'marital_status'    => $value['member_martial_status'],
								        'contact'           => $value['member_primary_mobile_no.'],
								        'email'             => $value['member_primary_email_id'],
								        'blood_group'       => $value['member_blood_group'],
								        'address'           => $value['member_address_line_1'],
								        'alt_address'       => $value['member_address_line_2'],
       									'city'              => $value['member_townvillagecity'],
								        'pincode'           => $value['member_address_pincode'],
								        'occupation'        => $value['member_occupation'],
								        'qualification'     => $value['member_education'],
								        'native_address'    => $value['member_native_place'],
								        'dist'              => $value['member_district'],
								        'native_pincode'    => $value['member_native_pincode'],
								        'profile_photo'     => '',
								        'member_type'       => $value['membertype'],
								        'member_code'       => strval((int)$value['member_code'])
								    ]);


	                }
	            }


	        }
	    }

	    return ["success" => true];

	}

    public function assign_khanp(){

        $members = Member::all();
        foreach($members as $member){

            $surname = Surname::where('name', 'like', '%' . $member->l_name. '%')->first();

            if(!$surname)
            {
                  continue;
            }
            $khanp_id = $surname->khanp_id;

        	Member::find($member->id)->update([
				'khanp' => $khanp_id
			]);

    	}
    	return ["success" => true];

    }

      public function assign_region(){

        $members = Member::all();
        foreach($members as $member){

            $region = Region::where('pincode', 'like', '%' . $member->pincode. '%')->get();

            if(!$region)
            {
                  continue;
            }

            $member_id = $member->id;

            foreach ($region as $key => $value) {

	        	$region = Region::where('id', $value->id)->first();

		        $member = json_decode($region->members);

		        array_push($member,$member_id);

		        $region  = Region::findOrfail($value->id);

                $region->update([
                    'members' => json_encode($member)
                ]);

            }

    	}
    	return ["success" => true];

    }

    public function update_member(Request $request){

	    if($request->hasFile('import_file')){


	        $path = $request->file('import_file')->getRealPath();
	        $data = Excel::load($path, function($reader) {})->get();

	        if(!empty($data) && $data->count()){

	            foreach ($data->toArray() as $key => $value) {

					// print_r($value);die();
					// if(!isset($value[0]))
					// {
					// }
					// $value = $value[0];

	                if(!empty($value)){

					         Member::where([
                                        ['member_type', '=', $value['membertype']],
                                        ['member_code', '=', number_format($value['member_code'],0,'.','')]
                                        ])
					         ->update([
			                    'address' => $value['member_address_line_1'],
			                    'alt_address' => $value['member_address_line_2'],
			                    'city' => $value['member_townvillagecity'],
			                    'alt_city' => $value['member_state'],
			                ]);


	                }
	            }


	        }
	    }

	    return ["success" => true];

    }


}
