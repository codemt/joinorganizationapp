<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use App\Venue;
use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\DB;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $venue = Venue::all();

        return view('superadmin.venue.index',compact('venue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('superadmin.venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Venue::create([
            'name'          => $request->name,
            'capacity'      => $request->capacity,
            'rent'          => $request->rent,
            'contactperson' => $request->contactperson,
            'contactnumber' => $request->contactnumber,
            'address'       => $request->address,
            'lat'           => $request->lat,
            'lang'          => $request->lang,
            'actual_address'=> $request->actual_address,
            ]);

        Session::flash('success','Venue Created Successfully!');

        $venue = Venue::all();

        return view('superadmin.venue.index',compact('venue'));
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
         $venue = Venue::find($id);
         return view('superadmin.venue.edit',compact('venue'));
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

         $venue  = Venue::findOrfail($request->id);

         $venue->update([
             'name' =>  $request->name,
             'capacity' =>  $request->capacity,
             'rent' =>  $request->rent,
             'contactperson' =>  $request->contactperson,
             'contactnumber' =>  $request->contactnumber,
             'lat' =>  $request->lat,
             'lang' =>  $request->lang,
             'actual_address' =>  $request->actual_address
         ]);

         Session::flash('success','Venue Updated!');
         $venue = Venue::all();

         return view('superadmin.venue.index',compact('venue'));
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
