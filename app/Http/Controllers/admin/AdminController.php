<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    
    public function login(Request $request){
        if($request->isMethod('post')){
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
                return redirect('admin/dashboard');
            }
            return redirect()->back()->with(['error_message'=>'Email and Password did not match']);
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
 