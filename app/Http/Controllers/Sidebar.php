<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\Count;
use App\Models\Faq;
use App\Models\Info;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\PortfolioPosition;
use App\Models\Service;
use App\Models\Tag;
use App\Models\TermsPolicies;
use Illuminate\Http\Request;

class Sidebar extends Controller
{
    public function index(){
        return view('backend.dashboard');
    }
    public function portfolio_cat(){
        $portfolio_cat = PortfolioCategories::all();
        return view('backend.portfolio.portfolio_cat',compact('portfolio_cat'));
    }
    public function portfolio_position(){
        $portfolio_position = PortfolioPosition::with('getPortfolioCategory')->get();
        // return $portfolio_position;
        $portfolio_cat = PortfolioCategories::get();
        $portfolio_item = PortfolioItem::get();
        return view('backend.portfolio.portfolio_position',compact('portfolio_position','portfolio_cat','portfolio_item'));
    }

    public function clients(){
        $clients = Client::all();
        return view('backend.clients.clients',compact('clients'));
    }
    public function services(){
        $services = Service::all();
        return view('backend.services.services',compact('services'));
    }
    public function tags(){
        $tags = Tag::all();
        return view('backend.tags.tags',compact('tags'));
    }
    public function catServices(){
        $catservices = CategoryRelatedServices::with('getPortfolioCategory')->get();
//        return $catservices;
        $portfolio_cat = PortfolioCategories::all();
        return view('backend.services.categoryrelatedservices',compact('catservices','portfolio_cat'));
    }

    public function infos(){
        $infos = Info::all();
        return view('backend.infos.infos',compact('infos'));
    }
    public function counts(){
        $counts = Count::all();
        return view('backend.count.count',compact('counts'));
    }
    public function faqs(){
        $faqs = Faq::all();
        return view('backend.faqs.faqs',compact('faqs'));
    }
    public function terms(){
        $terms = TermsPolicies::all();
        return view('backend.terms_policies.termspolicies',compact('terms'));
    }


    public function portfolioItem(){
        $portfolioitems = PortfolioItem::all();
        $portfolio_cat = PortfolioCategories::all();
        $clients = Client::all();
        $tags = Tag::all();
        return view('backend.portfolio.portfolioitems',compact('portfolioitems','portfolio_cat','clients','tags'));
    }


}
