<?php

namespace App\Http\Controllers;

use App\Models\TermsPolicies;
use Illuminate\Http\Request;

class TermsPoliciesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'subtitle'=>'required',
        ]);
        $terms = new TermsPolicies();
        $terms->title = $request->title;
        $terms->subtitle = $request->subtitle;
        $terms->description = $request->description;
        $terms->save();
        return response()->json($terms);
    }

    public function edit($id)
    {
        $terms = TermsPolicies::find($id);
        return response()->json($terms);
    }

    public function updated(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'subtitle'=>'required',
        ]);
        $terms = TermsPolicies::find($request->category_id);
        $terms->title = $request->title;
        $terms->subtitle = $request->subtitle;
        $terms->description = $request->description;
        $terms->save();
        return response()->json($terms);
    }







    public function destroy(Request $request)
    {
        $terms = TermsPolicies::find($request->id);
        $terms->delete();
        return response()->json('terms');
    }
}
