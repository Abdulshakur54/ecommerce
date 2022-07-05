<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorBankDetail;
use App\Models\VendorBusiness;
use Illuminate\Support\Facades\Hash;
use Image;

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
        $email = Admin::where('email', Auth::guard('admin')->user()->email)->first()->email;
        if ($request->isMethod('post')) {
            if ($this->confirmAdminPassword($request) == 'true') {
                if ($request->confirm_new_password == $request->new_password) {
                    // Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>Hash::make($request->password)]);
                    $row = Admin::find(Auth::guard('admin')->user()->id);
                    $row->password = Hash::make($request->new_password);
                    $row->update();
                    return redirect('admin/change_password')->with('success_message', 'Password has beeen successfully changed');
                } else {
                    return redirect('admin/change_password')->with('error_message', 'New Password does not match Confirm New Password');
                }
            } else {
                return redirect('admin/change_password')->with('error_message', 'Current Password is not correct');
            }
        }
        return view('admin.settings.change_password', ['email' => $email]);
    }

    private function confirmAdminPassword(Request $request)
    {
        if (Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->updateAdminProfile($request);
            return redirect()->back()->with('success_message', 'Your Profile has been updated');
        }
        return view('admin.settings.update_profile');
    }

    private function updateAdminProfile(Request $request)
    {
        $admRecord = Admin::find(Auth::guard('admin')->user()->id);
        $rules = [
            'name' => 'required|max:50|min:3|regex:/^[a-z ]+$/i',
            'mobile' => 'required|digits:11|regex:/^0[7-9][01][0-9]{8}$/',
        ];
        if ($request->has('profile_photo')) {
            $rules['profile_photo'] = 'image|mimes:jpeg,jpg,png,PNG,JPEG,JPG|max:2048';
        }
        $request->validate($rules);
        $storedName = Auth::guard('admin')->user()->image;
        if ($request->has('profile_photo')) {
            if (!empty(Auth::guard('admin')->user()->image)) {
                unlink(Auth::guard('admin')->user()->image);
            }
            $imageObj = $request->file('profile_photo');
            $storedName = 'admin/images/profile_photo/' . bin2hex(random_bytes(3)) . '.' . $imageObj->getClientOriginalExtension();
            Image::make($imageObj)->save($storedName);
        }

        $admRecord->name = $request->name;
        $admRecord->mobile = $request->mobile;
        $admRecord->image = $storedName;
        $admRecord->update();
    }

    public function updateVendorDetails(Request $req, $slug)
    {
        switch ($slug) {
            case 'personal':
                $vendorDetails = Vendor::where('id',Auth::guard('admin')->user()->id)->first();
                if ($req->isMethod('post')) {
                    $rules = [
                        'name' => 'required|max:50|min:3|regex:/^[a-z ]+$/i',
                        'address' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required',
                        'pincode' => 'required|numeric',
                        'mobile' => 'required|digits:11|regex:/^0[7-9][01][0-9]{8}$/',
                    ];

                    $req->validate($rules);
                    $this->updateAdminProfile($req);

                    $vendorDetails->name = $req->name;
                    $vendorDetails->address = $req->address;
                    $vendorDetails->city = $req->city;
                    $vendorDetails->state = $req->state;
                    $vendorDetails->country = $req->country;
                    $vendorDetails->pincode = $req->pincode;
                    $vendorDetails->mobile = $req->mobile;
                    $vendorDetails->update();
                    return redirect()->back()->with('success_message', 'Your Profile has been updated');
                }
                return view('admin.settings.update_vendor_details', compact('vendorDetails'));
            case 'business':
                $businessDetails = VendorBusiness::where('vendor_id', Auth::guard('admin')->user()->id)->first();
                if ($req->isMethod('post')) {
                    $rules = [
                        'shop_name' => 'required|max:50|min:3|regex:/^[a-z ]+$/i',
                        'shop_address' => 'required',
                        'shop_city' => 'required',
                        'shop_state' => 'required|alpha',
                        'shop_country' => 'required|alpha',
                        'shop_pincode' => 'required|numeric',
                        'shop_mobile' => 'required|digits:11|regex:/^0[7-9][01][0-9]{8}$/',
                        'shop_website' => 'required',
                        'shop_email' => 'required|email',
                        'address_proof' => 'required',
                        'business_license_number' => 'required|numeric',
                        'gst_number' => 'required|numeric',
                        'pan_number' => 'required|numeric',
                    ];
                    if ($req->has('address_proof_image')) {
                        $rules['address_proof_image'] = 'image|mimes:jpeg,jpg,png,PNG,JPEG,JPG|max:2048';
                    }
                    $req->validate($rules);
                    $storedName = $businessDetails->address_proof_image;
                    $rules['address_proof_image'] = 'image|mimes:jpeg,jpg,png,PNG,JPEG,JPG|max:2048';
                    if ($req->has('address_proof_image')) {
                        if ($storedName) {
                            unlink($storedName);
                        }
                        $imageObj = $req->file('address_proof_image');
                        $storedName = 'admin/images/shop_proof/' . bin2hex(random_bytes(3)) . '.' . $imageObj->getClientOriginalExtension();
                        Image::make($imageObj)->save($storedName);
                    }
                    $req->validate($rules);
                    $businessDetails->shop_name = $req->shop_name;
                    $businessDetails->shop_address = $req->shop_address;
                    $businessDetails->shop_city = $req->shop_city;
                    $businessDetails->shop_state = $req->shop_state;
                    $businessDetails->shop_country = $req->shop_country;
                    $businessDetails->shop_pincode = $req->shop_pincode;
                    $businessDetails->shop_mobile = $req->shop_mobile;
                    $businessDetails->shop_website = $req->shop_website;
                    $businessDetails->shop_email = $req->shop_email;
                    $businessDetails->address_proof = $req->address_proof;
                    $businessDetails->address_proof_image = $storedName;
                    $businessDetails->business_license_number = $req->business_license_number;
                    $businessDetails->gst_number = $req->gst_number;
                    $businessDetails->pan_number = $req->pan_number;
                    $businessDetails->update();
                    return redirect()->back()->with('success_message', 'Your Profile has been updated');
                }
                return view('admin.settings.update_business_details', compact('businessDetails'));
            case 'bank':
                $bankDetails = VendorBankDetail::where('vendor_id', Auth::guard('admin')->user()->id)->first();

                if ($req->isMethod('post')) {
                    $rules = [
                        'account_name' => 'required|max:50|min:3|regex:/^[a-z ]+$/i',
                        'bank_name' => 'required|max:50|min:3|regex:/^[a-z ]+$/i',
                        'account_number' => 'required|digits:10',
                        'bank_ifsc_code' => 'required|digits:10'
                    ];

                    $req->validate($rules);

                    $bankDetails->account_name = $req->account_name;
                    $bankDetails->bank_name = $req->bank_name;
                    $bankDetails->account_number = $req->account_number;
                    $bankDetails->bank_ifsc_code = $req->bank_ifsc_code;
                    $bankDetails->update();
                    return redirect()->back()->with('success_message', 'Your Profile has been updated');
                }
                return view('admin.settings.update_bank_details', compact('bankDetails'));
        }
    }

    public function admins($slug = null){
        if($slug == 'all'){
            $admins = Admin::where('type','!=','superadmin')->get();
        }else{
            $admins = Admin::where('type',$slug)->get();
        }
        $type = $slug;
       return view('admin.admins.admins',compact('admins','type'));
    }

    public function viewVendorDetails($vendorId){
        $vendorDetails = Vendor::where('id',$vendorId)->first();
        $businessDetails = VendorBusiness::where('vendor_id', $vendorId)->first();
        $bankDetails = VendorBankDetail::where('vendor_id', $vendorId)->first();
        $profileImage = Admin::find($vendorId)->image;
        $businessImage = VendorBusiness::where('vendor_id', $vendorId)->first()->address_proof_image;
        return view('admin.view_vendor_details',compact('vendorDetails','businessDetails','bankDetails','profileImage','businessImage'));
    }


    public function updateAdminStatus(Request $request){
        $adm = Admin::where('vendor_id',$request->adm_id)->first();
        $adm->status = $request->status;
        $adm->update();
       
        if($adm->type == 'vendor'){
            $vendor = Vendor::where('id',$request->adm_id)->first();
            $vendor->status = $request->status;
            $vendor->update();
        }
        return response()->json(['statuscode' => 200]);
    }
}
