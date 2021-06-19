<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use function unlink;
class InfosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mobile'=>'required',
            'email'=>'required',
            'address'=>'required',
            'image'=>'required',
        ]);
        $infos = new Info();
        $infos->mobile = $request->mobile;
        $infos->email = $request->email;
        $infos->address = $request->address;
        if ($request->hasFile('image')) {
            $path = 'images/infos/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $infos->logo = $path . $imageName;
        }
        $infos->facebook_url = $request->facebook_url;
        $infos->instagram_url = $request->instagram_url;
        $infos->linkedin_url = $request->linkedin_url;
        $infos->youtube_url = $request->youtube_url;
        $infos->save();

        $range = Info::all()->count();
        return response()->json([
            "infos"=>$infos,"range"=>$range
        ]);

    }

    public function edit($id)
    {
        $data  = Info::find($id);
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

    public function updated(Request $request)
    {
        $request->validate([
            'mobile'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);
        $infos = Info::find($request->category_id);
        $infos->mobile = $request->mobile;
        $infos->email = $request->email;
        $infos->address = $request->address;
        if($request->hasFile('image'))
        {
            $path           = 'images/infos/';
            @unlink($infos->icon);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $infos->logo      = $path.$imageName;
        }
        $infos->facebook_url = $request->facebook_url;
        $infos->instagram_url = $request->instagram_url;
        $infos->linkedin_url = $request->linkedin_url;
        $infos->youtube_url = $request->youtube_url;
        $infos->save();
        return response()->json($infos);
    }

    public function destroy(Request $request)
    {
        $infos = Info::find($request->id);

        $infos->delete();
        $range = Info::all()->count();

        return response()->json($range);
    }
}
