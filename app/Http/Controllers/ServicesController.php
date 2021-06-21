<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicesController extends Controller
{
    //Store Data
    public function store(Request $request){
        $request->validate([
            'service_name' => 'required',
        ]);
        $category= new Service();
        $category->service_name    = $request->service_name;
        $category->service_name_id    = $request->reqservice;
        $category->save();
        return response()->json($category);

    }

    //Edit Data
    public function edit($id){
        $data  = Service::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }


    //Update Data
    public function updated(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
        ]);
        $service = Service::find($request->category_id);
        $service->service_name = $request->service_name;
        $service->service_name_id = $request->reqservice;
        $service->save();
        return response()->json($service);
    }

    //Delete Data
    public function destroy(Request $request){
        $clients = Service::find($request->id);
        $clients->delete();
        return response()->json('clients');
    }
}
