<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\PortfolioCategories;
use Illuminate\Http\Request;
use function unlink;

class CategoryRelatedServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id'=>'required',
            'name'=>'required',
            'image'=>'required | max:300',
            'position'=>'required',

        ]);

        $catservices = new CategoryRelatedServices();
        $catservices->portfolio_category_id = $request->portfolio_category_id;
        $catservices->name = $request->name;
        if ($request->hasFile('image')) {
            $path = 'images/portfolio_services/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $catservices->icon = $path . $imageName;
        }
        $catservices->position = $request->position;
        $catservices->save();
        return response()->json($catservices);
    }

    public function edit($id)
    {
        $category = CategoryRelatedServices::find($id);
        return response()->json($category);
    }

    public function updated(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $catservices = CategoryRelatedServices::find($request->category_id);
        $catservices->portfolio_category_id = $request->portfolio_category_id;
        $catservices->name = $request->name;
        $catservices->category_related_service_id;
        if($request->hasFile('image'))
        {
            $path           = 'images/portfolio_services/';
            @unlink($catservices->icon);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $catservices->icon      = $path.$imageName;
        }
        $positionValue = $catservices->position;
        if($request->position == null){
           $catservices->position = $positionValue;
        }else{
            $catservices->position = $request->position;
        }
        $catservices->save();
        return response()->json($catservices);
    }

    public function destroy(Request $request)
    {
        $tags = CategoryRelatedServices::find($request->id);
        $tags->delete();
        return response()->json('tags');
    }


    // Ajax controller function

    public function catServices(Request $request){
        $match_id=CategoryRelatedServices::where('portfolio_category_id',$request->id)
        ->WhereBetween('position',[1,12])->pluck('position')->toArray();
        $all = array("1", "2", "3", "4","5","6","7","8","9","10","11","12");
        $result = array_diff($all, $match_id);
        return response()->json($result);
    }
}
