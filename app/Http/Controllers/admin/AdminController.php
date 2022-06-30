<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Username is required',
                'password.required' => 'Password is required',
            ];
            $request->validate($rules, $customMessages);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect('admin/dashboard');
            }
            return redirect()->back()->with(['error_message' => 'Email and Password did not match']);
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function changePassword(Request $request)
    {
        $email = Admin::where('email',Auth::guard('admin')->user()->email)->first()->email;
        if($request->isMethod('post')){
           if($this->confirmAdminPassword($request) == 'true'){ 
                if($request->confirm_new_password == $request->new_password){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>Hash::make($request->password)]);
                    // $row = Admin::find(Auth::guard('admin')->user()->id);
                    // $row->password = Hash::make($request->new_password);
                    // $row->update();
                    return redirect('admin/change_password')->with('success_message','Password has beeen successfully changed');
                }else{
                    return redirect('admin/change_password')->with('error_message','New Password does not match Confirm New Password');
                }
           }else{
             return redirect('admin/change_password')->with('error_message','Current Password is not correct');
           }
          
        }
        return view('admin.change_password',['email'=>$email]);
    }

    public function confirmAdminPassword(Request $request){
        if(Hash::check($request->current_password,Auth::guard('admin')->user()->password)){
            return 'true';
        }else{
            return 'false';
        }
        
    }
}
