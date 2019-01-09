<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use App\Venue;
use App\Event;
use Illuminate\Http\Request;
use App\Region;
use App\Samiti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        return view('superadmin.events.index',compact('event'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $venue = Venue::all();
        $region = Region::all();
        $samiti = Samiti::all();
        return view('superadmin.events.create',compact('venue','region','samiti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageName = '';

        if($request->file('featured_image') != null)
        {
            $imageName = 'Event_'.$request->name.'.' .
            $request->file('featured_image')->getClientOriginalExtension();

            $request->file('featured_image')->move(
                base_path() . '/public/img/', $imageName
            );

            $imageName = 'img/'.$imageName;
        }


        Event::create([
            'name'          => $request->name,
        'regions'       => json_encode(explode(",", $request->regions)),
            'samiti'        => json_encode(explode(",", $request->samiti)),
        'sponsorship'   => $request->sponsorship,
            'description'   => $request->description,
        'timing'        => $request->timing,
        'interested'        => '[]',
            'featured_image'=> $imageName,
        'category'      => $request->category,
            'venue_id'      => $request->venue_id
            ]);

        Session::flash('success','Event Created Successfully!');

         $event = Event::all();

        return view('superadmin.events.index',compact('event'));

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

          $events = DB::table('event')
             ->join('venue', 'venue.id', '=', 'event.venue_id')
             ->select('event.*','venue.name as venue_name')
             ->where([
                 ['event.id','=',$id]
             ])
             ->get();

           $events = json_decode($events, true);

        foreach ($events as $key => $value) {

            $regions = json_decode($value["regions"], true);

            foreach ($regions as $key1 => $value1) {

                        $user = DB::table('regions')
                                 ->select('regions.*')
                                 ->where([
                                 ['regions.id', '=', $value1]
                                 ])
                                 ->get();

                        $user = json_decode($user, true);

                $events[$key]["region_array"][$key1] = $user[0]['name'];
            }

          $samiti = json_decode($value["samiti"], true);

          foreach ($samiti as $key2 => $value2) {

                        $user = DB::table('samiti')
                                 ->select('samiti.*')
                                 ->where([
                                 ['samiti.id', '=', $value2]
                                 ])
                                 ->get();

                        $user = json_decode($user, true);

                $events[$key]["samiti_array"][$key2] = $user[0]['name'];
            }

        }

        $venue = Venue::all();
        $region = Region::all();
        $samiti = Samiti::all();

        return view('superadmin.events.edit',compact('events','venue','region','samiti'));
    }

    public function view_user_events()
    {
// Auth::user()["id"]
        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];

        $regions = DB::table('regions')
                   ->select('regions.*')
                   ->get();

       $regions = json_decode($regions, true);

       $region_id_array = array();

        foreach ($regions as $key => $value) {

        $members = json_decode($value["members"], true);

             if(in_array($member_id, $members))
             {
                array_push($region_id_array,$value['id']);
             }

        }

        $event = DB::table('event')
                   ->select('event.*')
                   ->get();

       $event = json_decode($event, true);

       $event_id_array = array();

        foreach ($event as $key1 => $value1) {

        $regions_temp = json_decode($value1["regions"], true);

             if(array_intersect($region_id_array, $regions_temp))
             {
                array_push($event_id_array,$value1['id']);
             }

        }

        $event = DB::table('event')
                   ->join('venue', 'venue.id', '=', 'event.venue_id')
                   ->select('event.*','venue.name as venue_name','venue.actual_address as address')
                   ->whereIn('event.id',$event_id_array)
                   ->get();

        return view('user.index',compact('event','member_id'));
    }

    public function add_interest(Request $request)
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];

        $event = Event::where('id', $request->event_id)
                                ->get();

        $event = json_decode($event, true);

        $member = json_decode($event[0]['interested']);

        array_push($member,$member_id);

        $event  = Event::findOrfail($request->event_id);

            $event->update([
                'interested' => json_encode($member)
            ]);

        return ["status" => 'success'];
    }

    public function remove_interest(Request $request)
    {

        $temp = DB::table('members')
                    ->select('members.*')
                    ->where([
                    ['members.user_id', '=', Auth::user()["id"]]
                    ])
                    ->get();
        $temp = json_decode($temp, true);

        $member_id = $temp[0]['id'];

        $event = Event::where('id', $request->event_id)
                                ->get();

        $event = json_decode($event, true);

        $member = json_decode($event[0]['interested']);

        if (($key = array_search($member_id, $member)) !== false) {
             array_splice($member, $key, 1);
        }

        $event  = Event::findOrfail($request->event_id);

            $event->update([
                'interested' => json_encode($member)
            ]);

        return ["status" => 'success'];


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $imageName = '';

        if($request->file('featured_image') != null)
        {
            $imageName = 'Event_'.$request->name.'.' .
            $request->file('featured_image')->getClientOriginalExtension();

            $request->file('featured_image')->move(
                base_path() . '/public/img/', $imageName
            );

            $imageName = 'img/'.$imageName;

            $event  = Event::findOrfail($request->event_id);

                $event->update([
                    'name'          => $request->name,
                'regions'       => json_encode(explode(",", $request->regions)),
                    'samiti'        => json_encode(explode(",", $request->samiti)),
                'sponsorship'   => $request->sponsorship,
                    'description'   => $request->description,
                'timing'        => $request->timing,
                    'featured_image'=> $imageName,
                'category'      => $request->category,
                    'venue_id'      => $request->venue_id
                ]);



        }
        else
        {
            $event  = Event::findOrfail($request->event_id);

                $event->update([
                    'name'          => $request->name,
                'regions'       => json_encode(explode(",", $request->regions)),
                    'samiti'        => json_encode(explode(",", $request->samiti)),
                'sponsorship'   => $request->sponsorship,
                    'description'   => $request->description,
                'timing'        => $request->timing,
                'category'      => $request->category,
                    'venue_id'      => $request->venue_id
                ]);
        }


           $event = Event::all();
           return view('superadmin.events.index',compact('event'));

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
