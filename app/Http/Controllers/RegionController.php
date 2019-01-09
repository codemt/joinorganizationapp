<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use App\Region;
use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('superadmin.region.index');

    }

    public function get_regions_all()
    {
      $regions = DB::table('regions')
                 ->join('members', 'members.id', '=', 'regions.admin','left')
                 ->select('regions.id','regions.pincode','regions.name','regions.establishment_date',
                    'regions.members',
                    DB::raw('concat(members.f_name, " ", members.l_name) as admin_name'))
                 ->get();

        $regions = json_decode($regions, true);

        foreach ($regions as $key => $value) {

               if($value["members"] != "[]")
               {

                   $members = json_decode($value["members"], true);
                         foreach ($members as $key1 => $value1) {

                               $user = DB::table('members')
                                        ->select('members.*')
                                        ->where([
                                        ['members.id', '=', $value1]
                                        ])
                                        ->get();

                               $user = json_decode($user, true);
                               $regions[$key]["members_array"][$key1] = $user[0]['f_name']." ".$user[0]['l_name'];

               }

            }
            else
            {
                $regions[$key]["members_array"] = array();
            }

        }

        $data = array();
        foreach ($regions as $key => $region) {

            $region['members'] = json_decode($region['members']);

             array_push($data,array(
                $key,
                $region['name'],
                sizeof($region['members_array']),
                $region['admin_name'],
                $region['establishment_date'],
                '<p class="region hide">'.json_encode($region).'</p>
                    <a class="btn btn-outline-primary btn-xs members" title="Manage Members" tooltip>
                        <i class="icon icon-eye"></i>
                    </a>
                <a href="editregion/'.$region['id'].'" class="btn btn-outline-success btn-xs edit" title="Edit Region" tooltip>
                <i class="icon icon-edit"></i>
                </a>'
            ));

        }
        return response()->json(['data' => $data]);
    }

    public function get_regions_admin()
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

        foreach ($regions as $key => $value) {

               if($value["members"] != "[]")
               {

                   $members = json_decode($value["members"], true);
                         foreach ($members as $key1 => $value1) {

                               $user = DB::table('members')
                                        ->select('members.*')
                                        ->where([
                                        ['members.id', '=', $value1]
                                        ])
                                        ->get();

                               $user = json_decode($user, true);
                               $regions[$key]["members_array"][$key1] = $user[0]['f_name']." ".$user[0]['l_name'];

               }

            }
            else
            {
                $regions[$key]["members_array"] = array();
            }

        }

       // $regions = json_encode($regions, true);

        $member = Member::all();
        return view('superadmin.region.region_admin_region',compact('regions','member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = Member::all();
        $member1 = Member::all();
        return view('superadmin.region.create',compact('member','member1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regions = DB::table('regions')
                   ->get();

        $regions = json_decode($regions, true);

        $pincode_array = explode(",",$request->pincode);

        foreach($regions as $key => $value)
        {

            $temp = explode(",",$value["pincode"]);

               if(count(array_intersect($pincode_array,$temp)) > 0)
               {
                   Session::flash('success','Pincode already used');
                   return redirect()->route('region.create');
               }


        }

        Region::create([
            'name'                  => $request->name,
            'pincode'               => $request->pincode,
            'establishment_date'    => \DateTime::createFromFormat("d/m/Y", $request->establishment_date)->format("Y-m-d"),
            'members'               => '[]',
            'admin'                 => '',
        ]);

        Session::flash('success','Region Created Successfully!');
        return redirect()->route('region.index');
    }

    public function add_member_to_region(Request $request)
    {

        $region = Region::where('id', $request->region_id)
                             ->get();

        $member = json_decode($region[0]->members);

        array_push($member,$request->member_id);

        $region  = Region::findOrfail($request->region_id);

                $region->update([
                    'members' => json_encode($member)
                ]);

        return ["status" => 'success'];
    }

    public function get_member_from_region(Request $request)
    {

        $regions = DB::table('regions')
                   ->select('regions.id','regions.members')
                   ->whereIn('id', $request->region_id)
                   ->get();

        $regions = json_decode($regions, true);

        $members_array = array();

          foreach ($regions as $key => $value) {

                 if($value["members"] != "[]")
                 {

                     $members = json_decode($value["members"], true);
                           foreach ($members as $key1 => $value1) {

                                 $user = DB::table('members')
                                          ->select('members.*')
                                          ->where([
                                          ['members.id', '=', $value1]
                                          ])
                                          ->get();

                                 $user = json_decode($user, true);
                                 array_push($members_array,$user[0]);
                 }

              }

          }

        return ["data" => $members_array];
    }

    public function remove_member_from_region(Request $request)
    {

        $region = Region::where('id', $request->region_id)
                             ->get();

        $member = json_decode($region[0]->members);

        if (($key = array_search($request->member_id, $member)) !== false) {
             array_splice($member, $key, 1);
        }

        $region  = Region::findOrfail($request->region_id);

                $region->update([
                    'members' => json_encode($member)
                ]);

        return ["status" => 'success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = Region::find($id);
        $member = Member::all();
        $member1 = Member::all();
        $admins = Member::find(json_decode($regions->members));

        return view('superadmin.region.edit',compact('regions','member','member1','admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->name                   = $request->name;
        $region->pincode                = $request->pincode;
        if (strpos($request->establishment_date, '/') !== false) {
            $region->establishment_date     =  \DateTime::createFromFormat("d/m/Y", $request->establishment_date)->format("Y-m-d");
        }
        $region->admin                  = $request->admin;
        $region->save();

        Session::flash('success','Region Updated!');
        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return 'success';
    }
}
