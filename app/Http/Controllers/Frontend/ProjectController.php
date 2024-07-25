<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {

        $projectData = json_decode(Project::OrderBy('id', 'desc')->get());
        return view('Frontend.projects', ['projectData' => $projectData]);
    }
}
