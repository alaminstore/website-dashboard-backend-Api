<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PortfolioCategories;
use App\Models\PortfolioItem;
use App\Models\PortfolioPosition;
use App\Models\Service;
use App\Models\Tag;
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
}
