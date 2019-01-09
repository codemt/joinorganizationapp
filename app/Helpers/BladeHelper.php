<?php

use App\Member;
use App\Samiti;
use App\Region;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Gallery;


function getMemberByRegion($id){

	$regions = Region::find($id);

	$mem_id = [];
	foreach($regions as $region){
		$mem_id = array_merge($mem_id,json_decode($region->members,true));
	}

	$members = Member::find($mem_id);

	return $members;
}

function getRegionByMember($id){
	$member = Member::find($id);

	$regions = Region::all();

	foreach ($regions as $key => $region) {

		if(in_array($member->id,json_decode($region->members,true))){
			return $region;
			break;
		}
	}

	return false;
}
function getFirstGalleryImage($id) {
	$gallery = Gallery::find($id);

	$images = json_decode($gallery->images,true);
	return $images[0];

}

function getMemberType()
{

	$type = array();

	$temp = DB::table('members')
				->select('members.*')
				->where([
				['members.user_id', '=', Auth::user()["id"]]
				])
				->get();

	$temp = json_decode($temp, true);

	$id = $temp[0]['id'];

	$region = Region::where('admin',$id)->first();

    if($region)
	{
       array_push($type,'RA');
	}

	$samiti_admin = Samiti::where('admin_id',$id)->first();

	if($samiti_admin)
	{
	   array_push($type,'SA');
	}

	$samiti_member = Samiti::where('members', 'like', '%"' . $id . '"%')->first();

	if($samiti_member)
	{
	   array_push($type,'SM');
	}


	return $type;

}
