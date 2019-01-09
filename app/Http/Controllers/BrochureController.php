<?php

namespace App\Http\Controllers;

use App\Brochure;
use Illuminate\Http\Request;
use Session;
use Storage;

class BrochureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brochures = Brochure::all();
        return view('superadmin.brochure.index',compact('brochures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.brochure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'file'  => 'required|mimes:pdf,png,jpeg,jpg',
        ]);

        $filename = null;

        if($request->hasFile('file')){
              $filename = time().$request->file->getClientOriginalName();
              $request->file->storeAs('brochure', $filename);

        }

        Brochure::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => 'brochure/'.$filename,
        ]);

        Session::flash('success','Brochure Created Successfully');

        return redirect()->route('brochure.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function show(Brochure $brochure)
    {
        return Storage::download($brochure->file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function edit(Brochure $brochure)
    {
        return view('superadmin.brochure.edit',compact('brochure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brochure $brochure)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $filename = null;

        if($request->hasFile('file')){
              $filename = time().$request->file->getClientOriginalName();
              $request->file->storeAs('brochure', $filename);
              Storage::delete($brochure->file);
              $brochure->file = 'brochure/'.$filename;

        }

        $brochure->title = $request->title;
        $brochure->description = $request->description;
        $brochure->save();
        Session::flash('success','Brochure Updated Successfully');
        return redirect()->route('brochure.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brochure $brochure)
    {
        if(Storage::exists($brochure->file)){
            Storage::delete($brochure->file);
        }

        $brochure->delete();

        return response()->json(['success',true]);
    }


}
