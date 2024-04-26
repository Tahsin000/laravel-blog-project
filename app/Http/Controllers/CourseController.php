<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index()
    {
        return view('Backend.course');
    }
    public function getCourseData()
    {
        $result = json_decode(CourseModel::orderBy('id', 'desc')->get());
        return $result;
    }

    public function courseDetails(Request $request)
    {
        $id = $request->id;
        $result = json_decode(CourseModel::where('id', $id)->get());
        return $result;
    }

    public function courseDelete(Request $request)
    {
        $id = $request->id;
        $result = CourseModel::where('id', $id)->delete();
        return $result ? 1 : 0;
    }

    public function courseUpdate(Request $request)
    {
        $data = $request->only([
            'id', 'course_name',
            'course_des',
            'course_fee',
            'course_totalenroll',
            'course_totalclass',
            'course_link',
            'course_img'
        ]);
        return CourseModel::where('id', $data['id'])->update($data) !== false;
    }

    public function courseAddNew(Request $request)
    {
        $data = $request->only([
            'course_name',
            'course_des',
            'course_fee',
            'course_totalenroll',
            'course_totalclass',
            'course_link',
            'course_img'
        ]);
        return CourseModel::insert($data) ? 1 : 0;
    }
}
