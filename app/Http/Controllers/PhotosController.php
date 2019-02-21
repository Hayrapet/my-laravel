<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
    public function create($album_id){
        return view('photos.create')->with('album_id', $album_id);
    }
    public function store(Request $request){
        $this -> validate ($request, [
            'title'=>'required',
            'photo'=>'image|max:1500'
        ]);
        
       $filnameWithExt = $request->file('photo')->getClientOriginalName ();
        
        
        $filename = pathinfo($filnameWithExt, PATHINFO_FILENAME);
        
        $extension = $request->file('photo')->getClientOriginalExtension ();
        
        $filenameToStore=$filename.'_'.time().'.'.$extension;
        $phat=$request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);
        $photo = new Photo;
        $photo->album_id=$request->input('album_id');
        $photo->title=$request->input('title');
        $photo->description=$request->input('description');
        $photo->size=$request->file('photo')->getClientSize();
        $photo->photo=$filenameToStore;
        $photo->save();
        return Redirect('/albums/'.$request->input('album_id'))->with('success','Photo Upload');
    }
    public function show($id){
        $photo= Photo::find($id);
        return view('photos.show')->with('photo', $photo);
    }
    public function destroy($id){
      $photo=Photo::find($id);
        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){
            $photo->delete();
            return redirect('/albums')-> with('success','Photo Deleted');
        }
    }
    
}
