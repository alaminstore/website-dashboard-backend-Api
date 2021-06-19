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
        if($tags->save()){
            return response()->json($tags);
        }
    }

    public function edit($id){
        $data  = Tag::find($id);
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

    public function destroy(Request $request){
        $tags =  Tag::find($request->id);
        $tags->delete();
        return response()->json('tags');
    }


    public function updated(Request $request)
    {
        $request->validate([
            'tag' => 'required',
        ]);
        $tags = Tag::find($request->category_id);
        $tags->tag = $request->tag;
        $tags->save();
        return response()->json($tags);
    }
}
