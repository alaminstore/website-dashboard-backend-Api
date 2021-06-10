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
            'service_name' => 'required | string | max: 200',
        ]);
        $category= new Service();
        $category->service_name    = $request->service_name;
        if($category->save())
        {
            $notification = array('message' => 'Service added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('backend.serve')->with($notification);
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
            'service_name' => 'required | string | max: 200',
        ]);

        $category= Service::find($request->category_id);
        $category->service_name    = $request->service_name;
        if($category->save())
        {
            $notification = array('message' => 'Service updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('backend.serve')->with($notification);
    }

    //Delete Data
    public function destroy(Request $request){
        $portfolio_cat = Service::find($request->id);
        if ($portfolio_cat->delete()) {
            $notification = array('message' => 'Service deleted successfully', 'alert-type' => 'success');
        } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }
        return redirect()->route('backend.serve')->with($notification);
    }
}
