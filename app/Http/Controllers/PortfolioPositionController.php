<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategories;
use App\Models\PortfolioPosition;
use Illuminate\Http\Request;

class PortfolioPositionController extends Controller
{
    //Store Data
    public function store(Request $request){
        $request->validate([
            'nameid' => 'required',
            'itemid' => 'required',
            'position'=>'required'
        ]);
        $position= new PortfolioPosition();
        $position->portfolio_category_id    = $request->nameid;
        $position->portfolio_item_id    = $request->itemid;
        $position->position = $request->position;
        if($position->save())
        {
            $notification = array('message' => 'Portfolio Position added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('backend.portfolio_position')->with($notification);
    }



    public function edit($id){
        $category  = PortfolioPositionZQWSE::find($id);
        return response()->json($category);
    }


    //Delete Data
    public function destroy(Request $request){
        $portfolio_position = PortfolioPosition::find($request->id);
        if ($portfolio_position->delete()) {
            $notification = array('message' => 'Portfolio Position deleted successfully', 'alert-type' => 'success');
        } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }
        return redirect()->route('backend.portfolio_position')->with($notification);
    }

}
