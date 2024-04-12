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
    public function servicesDelete (Request $request) {
        $id = $request->id;
        $result = ServicesModel::where('id', $id)->delete();
        $result ? 1 : 0;
        // return redirect()->back();
    }
}
