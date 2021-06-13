<?php

namespace App\Http\Controllers;

use App\Models\PortfolioPosition;
use Illuminate\Http\Request;

class PortfolioItemsController extends Controller
{
    public function catToItem($id){
        $cat_id = PortfolioPosition::find($id);
        return response()->json($cat_id);
    }

}
