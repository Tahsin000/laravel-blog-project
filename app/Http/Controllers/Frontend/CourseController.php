<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index()
    {

        $courseData = json_decode(CourseModel::OrderBy('id', 'desc')->get());
        return view('Frontend.course', ['courseData' => $courseData]);
    }
}
