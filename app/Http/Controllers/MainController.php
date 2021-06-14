<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    function login(){
        return view('backend.auth.login');
    }

    function check(Request $request){
        $request->validate([
             'email'=>'required|email',
             'password'=>'required|min:8|max:12'
        ]);

        $userInfo = User::where('email','=', $request->email)->first();

        if(!$userInfo){
            return back()->with('fail','We do not recognize your email address');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/');

            }else{
                return back()->with('fail','Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('auth/login');
        }
    }

    // function dashboard(){
    //     $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
    //     return view('admin.dashboard', $data);
    // }

    // function settings(){
    //     $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
    //     return view('admin.settings', $data);
    // }

    // function profile(){
    //     $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
    //     return view('admin.profile', $data);
    // }
    // function staff(){
    //     $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
    //     return view('admin.staff', $data);
    // }
}
