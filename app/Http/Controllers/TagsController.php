<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'tag'=>'required'
        ]);
        $tags = new Tag();
        $tags->tag = $request->tag;
        $tags->save();
        return response()->json($tags);
    }

    public function edit($id){
        $category  = Tag::find($id);
        return response()->json($category);
    }

    public function destroy(Request $request){
        $tags =  Tag::find($request->id);
        $tags->delete();
        return response()->json('tags');
    }


    public function updated(Request $request)
    {
        $tags = Tag::find($request->category_id);
        $tags->tag = $request->tag;
        $tags->save();
        return response()->json($tags);
    }
}
