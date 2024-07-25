<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.review');
    }

    public function reviewsData()
    {
        $result = json_decode(Review::orderBy('id', 'desc')->get());
        // dd($result);
        return $result;
    }

    public function reviewAddNew(Request $request)
    {
        $data = $request->only([
            'image',
            'name',
            'description'
        ]);
        return Review::insert($data) ? 1 : 0;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->only([
            'image',
            'name',
            'description'
        ]);
        return Review::insert($data) ? 1 : 0;
    }

    public function reviewDetails(Request $request)
    {
        $id = $request->id;
        $result = json_decode(Review::where('id', $id)->get());
        return $result;
    }
    public function reviewDelete(Request $request)
    {
        $id = $request->id;
        $result = Review::where('id', $id)->delete();
        return $result ? 1 : 0;
    }
    public function reviewUpdate(Request $request)
    {
        $data = $request->only([
            'id', 'image',
            'name',
            'description'
        ]);
        return Review::where('id', $data['id'])->update($data) !== false;
    }
}
