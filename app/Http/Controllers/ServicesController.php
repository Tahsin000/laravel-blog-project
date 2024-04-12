<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function services () {
        return view('Backend.services');
    }
    public function servicesData () {
        $result = json_decode(ServicesModel::all());
        return $result;
    }
}
