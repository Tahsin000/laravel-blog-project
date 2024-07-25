<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.blog');
    }

    public function blogsData()
    {
        $result = json_decode(Blog::orderBy('id', 'desc')->get());
        // dd($result);
        return $result;
    }

    public function blogAddNew(Request $request)
    {
        $data = $request->only([
            'image',
            'title',
            'description',
        ]);
        return Blog::insert($data) ? 1 : 0;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->only([
            'image',
            'title',
            'description'
        ]);
        return Blog::insert($data) ? 1 : 0;
    }

    public function blogDetails(Request $request)
    {
        $id = $request->id;
        $result = json_decode(Blog::where('id', $id)->get());
        return $result;
    }
    public function blogDelete(Request $request)
    {
        $id = $request->id;
        $result = Blog::where('id', $id)->delete();
        return $result ? 1 : 0;
    }
    public function blogUpdate(Request $request)
    {
        $data = $request->only([
            'id', 'image',
            'title',
            'description'
        ]);
        return Blog::where('id', $data['id'])->update($data) !== false;
    }
}
