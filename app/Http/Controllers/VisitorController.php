<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public function adminDashboard () {
        return view('Backend.Layout.app');
    }
    public function HomeIndex () {
        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate = date("Y-m-d h:i:sa");
        
        VisitorModel::insert(['ip_address' => $UserIP, 'visit_time' => $timeDate]);
        
        $servicesData = json_decode(ServicesModel::all());
        $courseData = json_decode(CourseModel::OrderBy('id', 'desc')->limit(6)->get());

        return view('Frontend.home', [
            'servicesData' => $servicesData,
            'courseData' => $courseData
            
        ]);
    }

    public function adminIndex() {
        $VisitorData =json_decode(VisitorModel::orderBy('id', 'asc')->take(100)->get());
        return view('Backend.visitor', ['VisitorData' => $VisitorData]);
    }
}
