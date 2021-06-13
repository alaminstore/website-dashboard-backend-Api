<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\Count;
use App\Models\Faq;
use App\Models\GetQuotes;
use App\Models\Info;
use App\Models\PortfolioCategories;
use App\Models\Service;
use App\Models\TermsPolicies;
use Illuminate\Http\Request;

class AntroApiController extends Controller
{
    public function portfolio_cat(){
        return response()->json(PortfolioCategories::all(),200);
    }

    public function getCategoryById($id){
        $portfolio_categories = PortfolioCategories::find($id);
        if(is_null($portfolio_categories)){
            return response()->json(['message'=>'Portfolio Category not found'],404);
        }
        return response()->json($portfolio_categories::find($id),200);
    }


    public function categoryRelatedServices(){
        return response()->json(CategoryRelatedServices::all(),200);
    }

    public function categoryRelatedServicesById($id){
        $portfolio_categories = CategoryRelatedServices::find($id);
        if(is_null($portfolio_categories)){
            return response()->json(['message'=>'Category Service not found'],404);
        }
        return response()->json($portfolio_categories::find($id),200);
    }


    public function infos(){
        return response()->json(Info::all(),200);
    }
    public function infosById($id){
        $portfolio_categories = Info::find($id);
        if(is_null($portfolio_categories)){
            return response()->json(['message'=>'Sorry No Info has been found'],404);
        }
        return response()->json($portfolio_categories::find($id),200);
    }

    public function clients(){
        return response()->json(Client::all(),200);
    }



    public function clientsById($id){
        $clients = Client::where('precedence','=', $id)->get();
        // return response()->json($clients);
        if(empty($clients)){
            return response()->json(['message'=>'Sorry Client Info has not been found'],404);
        }
        return response()->json($clients,200);
    }









    public function counts(){
        return response()->json(Count::all(),200);
    }
    public function countsById($id){
        $portfolio_categories = Count::find($id);
        if(is_null($portfolio_categories)){
            return response()->json(['message'=>' Not found'],404);
        }
        return response()->json($portfolio_categories::find($id),200);
    }

    public function terms(){
        return response()->json(TermsPolicies::all(),200);
    }
    public function termsById($id){
        $portfolio_categories = TermsPolicies::find($id);
        if(is_null($portfolio_categories)){
            return response()->json(['message'=>' Not found'],404);
        }
        return response()->json($portfolio_categories::find($id),200);
    }


    public function services(){
        return response()->json(Service::all(),200);
    }
    public function servicesById($id){
        $services = Service::find($id);
        if(is_null($services)){
            return response()->json(['message'=>' Not found'],404);
        }
        return response()->json($services::find($id),200);
    }


    public function faqs(){
        return response()->json(Faq::all(),200);
    }
    public function faqsById($id){
        $Faq = Faq::find($id);
        if(is_null($Faq)){
            return response()->json(['message'=>' Not found'],404);
        }
        return response()->json($Faq::find($id),200);
    }

    public function getQuotes(Request $request){
        $quotes = GetQuotes::create($request->all());
        return response($quotes,201);
    }

    public function quotes(){
        return response()->json(GetQuotes::all(),200);
    }


}
