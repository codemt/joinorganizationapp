<?php

namespace App\Http\Controllers;

use App\Obituary;
use App\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ObituaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obituary = Obituary::all();
        return view('superadmin.obituary.index',compact('obituary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = Member::all();
        return view('superadmin.obituary.create',compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageName = 'Obituary_'.$request->member_id.'.' .
        $request->file('profile_image')->getClientOriginalExtension();

        $request->file('profile_image')->move(
            base_path() . '/public/img/', $imageName
        );

        $imageName = 'img/'.$imageName;

        Obituary::create([
            'photo'          => $imageName,
            'member_id'      => $request->member_id,
            'died_on'          => Carbon::createFromFormat('d/m/Y', $request->died_on),
            'obituary_date' => Carbon::createFromFormat('d/m/Y', $request->obituary_date),
            'description' => $request->description,
            'description_one' => $request->description_one,
            'description_two' => $request->description_two,
            'description_three' => $request->description_three,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $request->birth_date)
        ]);

        $obituary = Obituary::all();
        return view('superadmin.obituary.index',compact('obituary'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Obituary  $obituary
     * @return \Illuminate\Http\Response
     */
    public function show(Obituary $obituary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Obituary  $obituary
     * @return \Illuminate\Http\Response
     */
    public function edit(Obituary $obituary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Obituary  $obituary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obituary $obituary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Obituary  $obituary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obituary $obituary)
    {
        //
    }
}
