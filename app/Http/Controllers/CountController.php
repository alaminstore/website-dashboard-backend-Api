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
        $count = Count::find($id);
        return response()->json($count);
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
