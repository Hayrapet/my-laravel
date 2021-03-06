<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

//barev
class AlbumsController extends Controller
{
    public function index(){
        $albums= Album::with('photos')->get();
        return view('albums.index')->with('albums',$albums) ;
    }
    
     public function create(){
        return view('albums.create');
    }
    public function store(Request $request){
        $this -> validate ($request, [
            'name'=>'required',
            'cover_image'=>'image|max:1500'
        ]);
        
       $filnameWithExt = $request->file('cover_image')->getClientOriginalName ();
        
        
        $filename = pathinfo($filnameWithExt, PATHINFO_FILENAME);
        
        $extension = $request->file('cover_image')->getClientOriginalExtension ();
        
        $filenameToStore=$filename.'_'.time().'.'.$extension;
        $phat=$request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);
        $album = new Album;
        $album->name=$request->input('name');
        $album->description=$request->input('description');
        $album->cover_image=$filenameToStore;
        $album->save();
        return Redirect('/albums')->with('success','Album Created');
    }
    public function show($id){
        $album= Album::with('Photos')->find($id);
        return view('albums.show')->with('album',$album);
    }
}
