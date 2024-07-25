<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\CourseModel;
use App\Models\Project;
use App\Models\Review;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public function adminDashboard()
    {
        $totalVisitor = VisitorModel::count();
        $totalServices = ServicesModel::count();
        $totalProjects = Project::count();
        $totalCourses = CourseModel::count();
        $totalContacts = Contact::count();
        $totalReviews = Review::count();
        return view(
            'Backend.dashboard',
            [
                'totalVisitor' => $totalVisitor,
                'totalServices' => $totalServices,
                'totalProjects' => $totalProjects,
                'totalCourses' => $totalCourses,
                'totalContacts' => $totalContacts,
                'totalReviews' => $totalReviews,
            ]
        );
    }
    public function HomeIndex()
    {
        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate = date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address' => $UserIP, 'visit_time' => $timeDate]);

        $servicesData = json_decode(ServicesModel::all());
        $courseData = json_decode(CourseModel::OrderBy('id', 'desc')->limit(6)->get());
        $projectData = json_decode(Project::OrderBy('id', 'desc')->limit(10)->get());
        $blogData = json_decode(Blog::OrderBy('id', 'desc')->limit(6)->get());
        $reviewData = json_decode(Review::all());
        // dd($projectData);
        return view('Frontend.home', [
            'servicesData' => $servicesData,
            'courseData' => $courseData,
            'projectData' => $projectData,
            'blogData' => $blogData,
            'reviewData' => $reviewData
        ]);
    }

    public function adminIndex()
    {
        $VisitorData = json_decode(VisitorModel::orderBy('id', 'asc')->take(100)->get());
        return view('Backend.visitor', ['VisitorData' => $VisitorData]);
    }
    public function contactSend(Request $request)
    {
        $contact_name = $request->input('contact_name');
        $contact_mobile = $request->input('contact_mobile');
        $contact_email = $request->input('contact_email');
        $contact_msg = $request->input('contact_msg');

        $result = Contact::insert([
            'contact_name' => $contact_name,
            'contact_mobile' => $contact_mobile,
            'contact_email' => $contact_email,
            'contact_msg' => $contact_msg
        ]);
        return ($result == true);
    }
}
