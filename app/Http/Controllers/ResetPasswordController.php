<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function oldPass(Request $request){
        $request->validate([
            'oldpass' => 'required|string',
        ]);
        // $oldPass = bcrypt($request->oldpass);
        $oldPass = $request->oldpass;
        $userInfo = User::where('id', 1)->first();
        if($userInfo){
           if(Hash::check($request->oldpass, $userInfo->password)){
            return response()->json(['success'=>true]);
           }else{
            return response()->json(['success'=>false]);
           }
        }
    }

    public function newPass(Request $request){
        $validator = Validator::make($request->all(),[
            'newPass' => 'required|string|min:8',
            'confirmPass' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $available = User::where('id', 1)->first();
            if($available){
                $newpass = $request->newPass;
                $confirmpass = $request->confirmPass;
                if($newpass == $confirmpass ){
                    $available->password = bcrypt($newpass);
                    $available->save();
                    // $pass = $request->newPass;
                    return response()->json([
                        'success'=>true,
                    ]);
                }else{
                    return response()->json(['success'=>false]);
                }
            }
        }

    }
}
