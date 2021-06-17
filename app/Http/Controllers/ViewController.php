<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategories;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewCat($id){
        $catview  = PortfolioCategories::find($id);
        return response()->json($catview);
    }
}
