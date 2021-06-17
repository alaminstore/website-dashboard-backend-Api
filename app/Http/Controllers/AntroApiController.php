<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\Count;
use App\Models\Faq;
use App\Models\GetQuotes;
use App\Models\Info;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\PortfolioPosition;
use App\Models\PortfolioTag;
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
//
    public function portfolioItem(){
        return response()->json(PortfolioItem::all(),200);
    }

    public function portfolioItemById($id){
        $portfolio_items = PortfolioItem::where('level',$id)->get();
        if(count($portfolio_items)==0){
            return response()->json(['message'=>'Item not found'],404);
        }
        return response()->json($portfolio_items,200);
    }


    public function portfolioPosition(){
        return response()->json(PortfolioPosition::with("getPortfolioCategory","getPortfolioItem")->get(),200);
    }

    public function portfolioPositionById($id){
        $portfolio_items = PortfolioPosition::with("getPortfolioCategory","getPortfolioItem")
                                             ->where('portfolio_position_id',$id)->first();
        if(is_null($portfolio_items)){
            return response()->json(['message'=>'Portfolio Position not found'],404);
        }
        return response()->json($portfolio_items,200);
    }

    public function portfolioTags(){
        return response()->json(PortfolioTag::with("getPortfolioItem")->get(),200);
    }
    // public function portfolioTags(){
    //     $tags = PortfolioTag::with("getPortfolioItem")->get();
    //     $tags->tag_id = json_decode($tags->tag_id);
    //     return response()->json($tags,200);
    // }

    public function portfolioTagsById($id){

        $portfolio_tags = PortfolioTag::with("getPortfolioItem")
                                             ->where('portfolio_tag_id',$id)->first();

        if($portfolio_tags){
            $portfolio_tags->tag_id = json_decode($portfolio_tags->tag_id);
            return response()->json($portfolio_tags,200);
        }else{
            return response()->json(['message'=>'Portfolio Tags not found'],404);
        }
    }


    public function categoryRelatedServices(){
        return response()->json(CategoryRelatedServices::all(),200);
    }

    public function categoryRelatedServicesById($id){
        $portfolio_categories = CategoryRelatedServices::where('level',$id)->get();
        if(count($portfolio_categories) == 0){
            return response()->json(['message'=>'Category Service not found'],404);
        }
        return response()->json($portfolio_categories,200);
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
