<?php

namespace App\Http\Controllers;
use Session;
use App\Gallery;
use Storage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('gallery.index',compact('gallery'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_array = array();
        if ($request->images != null) {


            foreach ($request->images as $key => $value) {
             
               $imageName = 'Gallery_'.$request->title .$key. '.' .$value->getClientOriginalExtension();

               $value->move(
                base_path() . '/public/gallery_images/', $imageName
            );

               array_push($image_array,$imageName);
           }

           Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'images' => json_encode($image_array)
        ]);
       }        
        Session::flash('success');
        return back();
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $images = json_decode($gallery->images,true);
        return view('gallery.show',compact('gallery','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
