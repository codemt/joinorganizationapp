<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use App\Samiti;
use Illuminate\Http\Request;
use App\Member;
use App\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SamitiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       if(Auth::user()["role"] == 1)
       {

           $type = getMemberType();

           $temp = DB::table('members')
                       ->select('members.*')
                       ->where([
                       ['members.user_id', '=', Auth::user()["id"]]
                       ])
                       ->get();

           $temp = json_decode($temp, true);

           $id = $temp[0]['id'];



           if(in_array('SA',$type))
           {

               $samiti = DB::table('samiti')
                         ->select('samiti.id','samiti.name','samiti.samiti_year','samiti.valid_till','samiti.members')
                         ->where([
                             ['samiti.admin_id', '=', $id]
                         ])
                         ->get();

                $samiti = json_decode($samiti, true);

                 foreach ($samiti as $key => $value) {

                     $members = json_decode($value["members"], true);

                     $samiti[$key]["members_no"] = sizeof($members);

                 }

           }
           elseif (in_array('RA',$type))
           {

            $regions = DB::table('regions')
                      ->select('regions.id')
                      ->where([
                      ['regions.admin', '=', $id]
                      ])
                      ->get();

            $temp = json_decode($regions, true);

            $id = $temp[0]['id'];

            $samiti = DB::table('samiti')
                      ->select('samiti.id','samiti.name','samiti.samiti_year','samiti.valid_till','samiti.members')
                      ->where([
                      ['samiti.regions', 'like', '%"' . $id . '"%']
                      ])
                      ->get();

            $samiti = json_decode($samiti, true);

              foreach ($samiti as $key => $value) {

                  $members = json_decode($value["members"], true);

                  $samiti[$key]["members_no"] = sizeof($members);

              }

           }
           elseif (in_array('SM',$type))
           {
               $samiti = DB::table('samiti')
                         ->select('samiti.id','samiti.name','samiti.samiti_year','samiti.valid_till','samiti.members')
                         ->where([
                             ['samiti.members', 'like', '%"' . $id . '"%']
                         ])
                         ->get();

                $samiti = json_decode($samiti, true);

                 foreach ($samiti as $key => $value) {

                     $members = json_decode($value["members"], true);

                     $samiti[$key]["members_no"] = sizeof($members);

                 }
           }
       }
       else
       {
           $samiti = DB::table('samiti')
                     ->select('samiti.id','samiti.name','samiti.samiti_year','samiti.valid_till','samiti.members')
                      ->get();

           $samiti = json_decode($samiti, true);

             foreach ($samiti as $key => $value) {

                 $members = json_decode($value["members"], true);

                 if($members)
                 {
                     $samiti[$key]["members_no"] = sizeof($members);
                 }
                 else
                 {
                     $samiti[$key]["members_no"] = 0;
                 }

                

             }
       }

        return view('superadmin.samiti.index',compact('samiti'));

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
        $region = Region::all();
        return view('superadmin.samiti.create',compact('member','member1','region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $members = array();

        if($request->member != null)
        {

            foreach ($request->member as $key => $value)
            {
                $members[$key] =
                [
                    'member' => $value,
                    'designation' => $request->designation[$key]
                ];
            }

        }

        Samiti::create([
            'name'          => $request->name,
            'samiti_year'   => $request->samiti_year,
            'valid_till'    => $request->valid_till,
            'admin_id'      => $request->admin_id,
            'members'       => json_encode($members),
            'regions'       => json_encode($request->region)
            ]);

        Session::flash('success','Region Created Successfully!');
        return redirect()->route('samiti.index');
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
        $samiti = Samiti::find($id);


        $members = json_decode($samiti->members,true);

        $regions = json_decode($samiti->regions,true);


        // foreach ($members as $key => $value) {

        //         $user = DB::table('members')
        //                  ->select('members.*')
        //                  ->where([
        //                  ['members.id', '=', $value['member']]
        //                  ])
        //                  ->get();

        //         $user = json_decode($user, true);

        // $members[$key]["member_name"] = $user[0]['f_name']." ".$user[0]['l_name'];

        // }

        // $regions = json_decode($samiti->regions, true);


        // foreach ($regions as $key1 => $value1) {


        //         $user = DB::table('members')
        //                  ->select('members.*')
        //                  ->where([
        //                  ['members.id', '=', $value['member']]
        //                  ])
        //                  ->get();

        //         $user = json_decode($user, true);

        // $regions[$key]["region_name"] = $user[0]['f_name']." ".$user[0]['l_name'];

        // }

        $region_array = Region::all();

        $admin_id = $samiti->admin_id;

        return view('superadmin.samiti.edit_samiti',compact('samiti','members','member_array1','member_array2','member_array3','region_array','regions','admin_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Samiti $samiti)
    {

        $members = array();

        if($request->member != null)
        {
            foreach ($request->member as $key => $value)
            {
                $members[$key] =
                [
                    'member' => $value,
                    'designation' => $request->designation[$key]
                ];
            }


        }

      if($request->name != null)
      {
        $samiti->name                   = $request->name;
      }

      if($request->samiti_year != null)
      {
        $samiti->samiti_year                   = $request->samiti_year;
      }

      if($request->valid_till != null)
      {
        $samiti->valid_till                   = $request->valid_till;
      }

      if($request->admin_id != null)
      {
        $samiti->admin_id                   = $request->admin_id;
      }

      if($request->regions != null)
      {
        $samiti->regions                   = json_encode($request->region);
      }

        $samiti->members                = json_encode($members);

        $samiti->save();

        Session::flash('success','Samiti Updated!');
        return redirect()->route('samiti.index');
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
