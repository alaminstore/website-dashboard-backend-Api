<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\PortfolioPosition;
use App\Models\PortfolioTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PortfolioItemsController extends Controller
{
    public function catToItem($id){
        $cat_id = PortfolioCategories::find($id);
        return response()->json($cat_id);
    }

    public function dataPass(Request $request){
        $data = $request->passingdata;
        $portfolioitems = PortfolioItem::all();
        $portfolio_cat = PortfolioCategories::all();
        $clients = Client::all();
        $tags = Tag::all();
        return view('backend.portfolio.portfolioitemadd',compact('data','portfolioitems','clients','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url'=>'required',
            'image'=>'required',
            'client_id'=>'required'
        ]);
        $items = new PortfolioItem();
        $items->title = $request->title;
        $items->url = $request->url;

        if ($request->hasFile('image')) {
            $path = 'images/portfolio-items/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $items->image = $path . $imageName;
        }
        $items->client_id = $request->client_id;
        // return $items;
        $items->save();
        $items_Id = $items->portfolio_item_id;

        $position = new PortfolioPosition();
        $position->portfolio_category_id = $request->portfolio_category_id;
        $position->portfolio_item_id = $items_Id;
        $position->position = $request->position;
        $position->save();

        $tags = new PortfolioTag();
        $tags->portfolio_item_id = $items_Id;
        if($request->tag_id){
            $tags->tag_id = json_encode($request->tag_id);
        }
        $tags->save();
        if($tags->save())
        {
            $notification = array('message' => 'Portfolio Item added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('backend.portfolioItem')->with($notification);
    }


    public function destroy(Request $request){
        $items =  PortfolioItem::find($request->id);
        $items->delete();
        return response()->json('items');
    }

}
