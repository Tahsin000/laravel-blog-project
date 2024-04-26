<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function services()
    {
        return view('Backend.services');
    }
    public function servicesData()
    {
        $result = json_decode(ServicesModel::orderBy('id', 'desc')->get());
        return $result;
    }
    public function servicesDelete(Request $request)
    {
        $id = $request->id;
        $result = ServicesModel::where('id', $id)->delete();
        return $result ? 1 : 0;
        // return redirect()->back();
    }

    public function servicesDetails(Request $request)
    {
        $id = $request->id;
        $result = json_decode(ServicesModel::where('id', $id)->get());
        return $result;
    }

    public function servicesUpdate(Request $request)
    {
        $data = $request->only(['id', 'services_name', 'services_des', 'services_img']);
        return ServicesModel::where('id', $data['id'])->update($data) !== false;
    }

    public function servicesAddNew(Request $request)
    {
        $data = $request->only(['services_name', 'services_des', 'services_img']);
        return ServicesModel::insert($data) ? 1 : 0;
    }
}
