<?php

namespace App\Http\Controllers;

use App\Models\GetQuotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReqServiceController extends Controller
{
    //Edit Data
    public function edit($id){
        $data  = GetQuotes::find($id);
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


    //Update Data
    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_name' => 'required',
            'email' => 'required|email',
        ]);
        $service = GetQuotes::find($request->category_id);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            if($service->service_name){
                $service->service_name = $request->service_name;
            }
            if($service->email){
                $service->email = $request->email;
            }
            $service->save();
            return response()->json($service);
        }
    }

    //Delete Data
    public function destroy(Request $request){
        $reqService = GetQuotes::find($request->id);
        if($reqService->delete()){
            return response()->json('reqService');
        }
    }
}
