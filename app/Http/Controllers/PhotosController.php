<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
//use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function create($album_id) {
    	return view('photos.create')->with('album_id', $album_id);
    }

    public function store(Request $request) {
	    $this->validate($request, [
		    'title' => 'required',
		    'photo' => 'image|max:1999'
	    ]);

	    //get filename with extension
	    $filenameWithExt = $request->file('photo')->getClientOriginalName();

	    // get just the filename
	    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

	    //get extension of image
	    $extension = $request->file('photo')->getClientOriginalExtension();

	    // Create new file name
	    $filenameToStore = $filename . '_' . time() . '.' . $extension;

	    // Upload image
	    $path = $request->file('photo')->storeAs('photos/' . $request->input('album_id'), $filenameToStore, 'public');

	    //using Storage

	    // Upload Photo
	    $photo = new Photo;
	    $photo->album_id = $request->input('album_id');
	    $photo->title = $request->input('title');
	    $photo->description = $request->input('description');
	    $photo->size = $request->file('photo')->getClientSize();
	    $photo->photo = $filenameToStore;

	    $photo->save();

	    return redirect('/albums/' . $request->input('album_id'))->with('success', 'Photo Uploaded');
    }

    public function show($id) {
	    $photo = Photo::find($id);
	    return view('photos.show')->with('photo', $photo);
    }

    public function destroy($id) {
    	$photo = Photo::find($id);

    	if('images/photos/'.$photo->album_id.'/'.$photo->photo) {

		    $photo->delete();

		    return redirect( '/' )->with( 'success', 'Photos Deleted' );
	    }
    }
}
