<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\Count;
use App\Models\Faq;
use App\Models\Info;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Tag;
use App\Models\TermsPolicies;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewCat($id){
        $catview  = PortfolioCategories::find($id);
        return response()->json($catview);
    }
    public function viewItem($id){
        $items  = PortfolioItem::with('getClient')->find($id);
        return response()->json($items);
    }
    public function viewClient($id){
        $clients  = Client::find($id);
        return response()->json($clients);
    }
    public function viewService($id){
        $services  = Service::find($id);
        return response()->json($services);
    }
    public function viewTag($id){
        $tags  = Tag::find($id);
        return response()->json($tags);
    }
    public function viewCatservice($id){
        $catServices  = CategoryRelatedServices::find($id);
        return response()->json($catServices);
    }
    public function viewInfo($id){
        $infos  = Info::find($id);
        return response()->json($infos);
    }
    public function viewCount($id){
        $counts  = Count::find($id);
        return response()->json($counts);
    }
    public function viewFaq($id){
        $faqs  = Faq::find($id);
        return response()->json($faqs);
    }
    public function viewTerm($id){
        $faqs  = TermsPolicies::find($id);
        return response()->json($faqs);
    }
}











