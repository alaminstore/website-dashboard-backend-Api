<?php

namespace App\Http\Controllers;

use App\Models\Count;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'parameter'=>'required',
            'value'=>'required',
            'position'=>'required',

        ]);
        $count = new Count();
        $count->parameter = $request->parameter;
        $count->value = $request->value;
        $count->position = $request->position;
        $count->save();
        return response()->json($count);
    }

    public function edit($id)
    {
        $data  = Count::find($id);
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
            'parameter'=>'required',
            'value'=>'required',
            'position'=>'required',

        ]);
        $count = Count::find($request->category_id);
        $count->parameter = $request->parameter;
        $count->value = $request->value;
        $count->position = $request->position;
        $count->save();
        return response()->json($count);
    }

    public function destroy(Request $request)
    {
        $count = Count::find($request->id);
        $count->delete();
        return response()->json('count');
    }
}
