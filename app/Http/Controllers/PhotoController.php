<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    //
    public function index()
    {
        return view('Backend.gallery');
    }
    public function PhotoJSON()
    {
        return Photo::take(8)->get();
    }
    public function PhotoJSONByID(Request $request)
    {
        $startId = $request->id;
        $endId = $startId + 8;
        // TODO - counting problem
        // return Photo::where('id', '>=', $startId)->where('id', '<', $endId)->get();
        return Photo::where('id', '>', $startId)->limit(8)->get();
    }

    public function upload(Request $request)
    {
        $photoPath = $request->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://" . $host . "/storage/" . $photoName;

        $result = Photo::insert(['location' => $location]);
        return $result;
    }
    public function photoDelete(Request $request)
    {
        $oldPhotoURL = $request->input('oldPhotoURL');
        $oldPhotoID = $request->input('id');

        $oldPhotoURLArray = explode("/", $oldPhotoURL);
        $oldPhotoName = end($oldPhotoURLArray);
        $deletePhotoFile = Storage::delete('public/'.$oldPhotoName);
        $deleteRow = Photo::where('id', $oldPhotoID)->delete();
        return ($deleteRow && $deletePhotoFile);

    }
}
