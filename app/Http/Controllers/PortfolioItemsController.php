<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\PortfolioPosition;
use App\Models\PortfolioTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use function unlink;

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
        $items->position_one = $request->position;
        $items->portfolio_category_id = $request->portfolio_category_id;

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
        return response()->json($items);
    }

    public function edit($id)
    {
        $items = PortfolioItem::with('getTag')->find($id);
        // dd($items->getTag);
        $items['tags'] = $items->getTag;
        return response()->json($items);
    }

    public function updated(Request $request)
    {
        $items = PortfolioItem::find($request->category_id);
        $items->title = $request->title;
        $items->url = $request->url;
        if($request->hasFile('image'))
        {
            $path = 'images/portfolio-items/';
            @unlink($items->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $items->image      = $path.$imageName;
        }
        if($request->client_id){
            $items->client_id = $request->client_id;
        }

        // return $items;
        $items->save();
        $items_Id = $items->portfolio_item_id;
        $position = PortfolioPosition::where('portfolio_item_id',$request->category_id)->first();
        $position->portfolio_category_id = $request->portfolio_category_id;
        $position->portfolio_item_id = $items_Id;
        if($request->position){
            $position->position = $request->position;
        }
        $position->save();
        $tags = PortfolioTag::where('portfolio_item_id',$request->category_id)->first();
        $tags->portfolio_item_id = $items_Id;
        if($request->tag_id){
            $tags->tag_id = json_encode($request->tag_id);
        }
        $tags->save();
        return response()->json($items);
    }

    public function destroy(Request $request){
        $items =  PortfolioItem::find($request->id);
        $position = PortfolioPosition::where('portfolio_item_id',$request->id)->get()->first();
        $primary = PortfolioPosition::where('portfolio_position_id',$position)->get()->first();
        $position->portfolio_position_id = $primary;
        if($position->delete()){
            if($items->delete()){
                return response()->json('items');
            }
        }
    }

    public function portfolioPositionSet(Request $request){
        $match_id=PortfolioPosition::where('portfolio_category_id',$request->id)
        ->WhereBetween('position',[1,9])->pluck('position')->toArray();
        $all = array("1", "2", "3", "4","5","6","7","8","9");
        $result = array_diff($all, $match_id);
        return response()->json($result);
    }
    public function portfolioPositionSetTwo(Request $request){
        $match_id=PortfolioPosition::where('portfolio_category_id',$request->id)
        ->WhereBetween('position',[1,9])->pluck('position')->toArray();
        $all = array("1", "2", "3", "4","5","6","7","8","9");
        $result = array_diff($all, $match_id);
        return response()->json($result);
    }


}
