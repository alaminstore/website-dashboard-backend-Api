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
use App\Models\Service;
use App\Models\Tag;
use App\Models\TermsPolicies;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function viewCat($id){
        $data=PortfolioCategories::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function viewItem($id){

        $data = PortfolioItem::with('getClient','getCategory','getTag')->find($id);

        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function viewClient($id){
        $data = Client::find($id);

        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function viewService($id){
        $data = Service::find($id);

        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function viewReqService($id){
        $data = GetQuotes::find($id);

        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
    public function viewTag($id){
        $data=Tag::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
    public function viewCatservice($id){
        $data=CategoryRelatedServices::with('getCategory')->find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
    public function viewInfo($id){
        $data  = Info::find($id);
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
              ]);
          }
          else{
            return response()->json([
                'success' => false,
                'data' => 'No information found'
              ]);
          }
    }
    public function viewCount($id){
        $data  = Count::find($id);
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
              ]);
          }
          else{
            return response()->json([
                'success' => false,
                'data' => 'No information found'
              ]);
          }
    }
    public function viewFaq($id){
        $data  = Faq::find($id);
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
              ]);
          }
          else{
            return response()->json([
                'success' => false,
                'data' => 'No information found'
              ]);
          }
    }
    public function viewTerm($id){
        $data  = TermsPolicies::find($id);
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
              ]);
          }
          else{
            return response()->json([
                'success' => false,
                'data' => 'No information found'
              ]);
          }
    }
}











