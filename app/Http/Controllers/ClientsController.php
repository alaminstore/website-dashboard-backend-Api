<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use function unlink;
use Illuminate\Validation\Rule;

class ClientsController extends Controller
{
    //Store Data
    public function store(Request $request){
        $request->validate([
            'name' => 'required | string | max: 200',
            'image'=>'required',
            'url'=>'required',
            'precedence'=>'required'
        ]);
        $category= new Client();
        $category->name    = $request->name;
        $category->image = $request->image;
        $category->url = $request->url;
        $category->precedence = $request->precedence;

        if ($request->hasFile('image')) {
            $path = 'images/clients/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $category->image = $path . $imageName;
        }

        if($category->save())
        {
            $notification = array('message' => 'New Client added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('backend.clients')->with($notification);
    }


    //Edit Data
    public function edit($id){
        $category  = Client::find($id);
        return response()->json($category);
    }


      //Update Data
    public function updated(Request $request){
        $request->validate([
            'name' => 'required | string | max: 200',
            'url' => 'required',

        ]);
        $category= Client::find($request->category_id);
        $category->name    = $request->name;
        $category->url = $request->url;
        $category->portfolio_category_id;
        if($request->hasFile('image'))
        {
            $path           = 'images/clients/';
            @unlink($category->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $category->image      = $path.$imageName;
        }
        $category->precedence = $request->position;
        if($category->save())
        {
            $notification = array('message' => 'Client Info updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('backend.clients')->with($notification);
    }


    //Delete Data
    public function destroy(Request $request){
        $portfolio_cat = Client::find($request->id);
        if ($portfolio_cat->delete()) {
            $notification = array('message' => 'Client Info deleted successfully', 'alert-type' => 'success');
        } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }
        return redirect()->route('backend.clients')->with($notification);
    }
}
