<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.project');
    }

    public function projectsData()
    {
        $result = json_decode(Project::orderBy('id', 'desc')->get());
        // dd($result);
        return $result;
    }

    public function projectAddNew(Request $request)
    {
        $data = $request->only([
            'image',
            'title',
            'description',
            'url'
        ]);
        return Project::insert($data) ? 1 : 0;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->only([
            'image',
            'title',
            'description',
            'url'
        ]);
        return Project::insert($data) ? 1 : 0;
    }

    public function projectDetails(Request $request)
    {
        $id = $request->id;
        $result = json_decode(Project::where('id', $id)->get());
        return $result;
    }
    public function projectDelete(Request $request)
    {
        $id = $request->id;
        $result = Project::where('id', $id)->delete();
        return $result ? 1 : 0;
    }
    public function projectUpdate(Request $request)
    {
        $data = $request->only([
            'id', 'image',
            'title',
            'description',
            'url'
        ]);
        return Project::where('id', $data['id'])->update($data) !== false;
    }
}
