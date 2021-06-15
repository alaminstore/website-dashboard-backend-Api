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
        $category->save();
        return response()->json($category);

    }

    //Edit Data
    public function edit($id){
        $category  = Service::find($id);
        return response()->json($category);
    }


    //Update Data
    public function updated(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
        ]);
        $tags = Service::find($request->category_id);
        $tags->service_name = $request->service_name;
        $tags->save();
        return response()->json($tags);
    }

    //Delete Data
    public function destroy(Request $request){
        $clients = Service::find($request->id);
        $clients->delete();
        return response()->json('clients');
    }
}
