<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategories;
use Illuminate\Http\Request;
use function unlink;
use Illuminate\Validation\Rule;
class PortfolioCategoriesController extends Controller
{
    public function index(){
        return view('backend.dashboard');
    }

    //Store Data
    public function portfolioStore(Request $request){
        $request->validate([
            'name' => 'required | string | max: 200  | unique:portfolio_categories',
            'description'=>'required',
            'image'=>'required'
        ]);
        $category= new PortfolioCategories();
        $category->name    = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $path = 'images/portfolio_Cat/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $category->icon = $path . $imageName;
        }
        if($category->save())
        {
            $notification = array('message' => 'Portfolio Category added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('backend.portfolio_cat')->with($notification);
    }


    public function portfolioEdit($id){
        $category  = PortfolioCategories::find($id);
        return response()->json($category);
    }


    //Update Data
    public function portfolioUpdated(Request $request)
    {
        $request->validate([
            'name' => ['required',  'string' , 'max: 200' ,Rule::unique('portfolio_categories', 'name')->ignore($request->name, 'name')->where(function ($query) use ($request) {
                $query->where('name', $request->name);
            })],
            'description'=>'required'
        ]);

        $category= PortfolioCategories::find($request->category_id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->portfolio_category_id;
        if($request->hasFile('image'))
        {
            $path           = 'images/portfolio_Cat/';
            @unlink($category->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $category->icon      = $path.$imageName;
        }
        if($category->save())
        {
            $notification = array('message' => 'Portfolio Category  updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('backend.portfolio_cat')->with($notification);
    }
    
    //Delete Data
    public function portfolioDestrotoy(Request $request){
        $portfolio_cat = PortfolioCategories::find($request->id);
        if ($portfolio_cat->delete()) {
            $notification = array('message' => 'Portfolio Category deleted successfully', 'alert-type' => 'success');
        } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }
        return redirect()->route('backend.portfolio_cat')->with($notification);
    }
}
