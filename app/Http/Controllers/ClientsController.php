<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PortfolioItem;
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
        $clients= new Client();
        $clients->name    = $request->name;
        $clients->image = $request->image;
        $clients->url = $request->url;
        $clients->precedence = $request->precedence;

        if ($request->hasFile('image')) {
            $path = 'images/clients/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $clients->image = $path . $imageName;
        }
        $clients->save();
        return response()->json($clients);
    }


    //Edit Data
    public function edit($id){
        $clients  = Client::find($id);
        return response()->json($clients);
    }


      //Update Data
    public function updated(Request $request){
        $request->validate([
            'name' => 'required | string | max: 200',
            'url' => 'required',

        ]);
        $clients= Client::find($request->category_id);
        $clients->name    = $request->name;
        $clients->url = $request->url;
        $clients->portfolio_category_id;
        if($request->hasFile('image'))
        {
            $path           = 'images/clients/';
            @unlink($clients->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $clients->image      = $path.$imageName;
        }
        if($request->precedence){
            $clients->precedence = $request->position;
        }

        $clients->save();
        return response()->json($clients);
    }


    //Delete Data
    public function destroy(Request $request){
        $clients = Client::find($request->id);
        $clients->delete();
        return response()->json('clients');
    }
}
