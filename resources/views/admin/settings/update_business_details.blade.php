@extends('admin.layout.layout');
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Business Details</h4>
                            <form class="forms-sample" method="post"
                                action="{{ url('admin/update_vendor_details/business') }}" enctype="multipart/form-data">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div>{{ Session::get('success_message') }}</div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @csrf

                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name"
                                        value="{{ $businessDetails->shop_name }}" name="shop_name">
                                </div>
                                <div class="form-group">
                                    <label for="shop_address">Shop Address</label>
                                    <input type="text" class="form-control" id="shop_address"
                                        value="{{ $businessDetails->shop_address }}" name="shop_address">
                                </div>
                                <div class="form-group">
                                    <label for="shop_city">Shop City</label>
                                    <input type="text" class="form-control" id="shop_city"
                                        value="{{ $businessDetails->shop_city }}" name="shop_city">
                                </div>
                                <div class="form-group">
                                    <label for="shop_state">Shop State</label>
                                    <input type="text" class="form-control" id="shop_state"
                                        value="{{ $businessDetails->shop_state }}" name="shop_state">
                                </div>
                                <div class="form-group">
                                    <label for="shop_country">Shop Country</label>
                                    <input type="text" class="form-control" id="shop_country"
                                        value="{{ $businessDetails->shop_country }}" name="shop_country">
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop Pincode</label>
                                    <input type="text" class="form-control" id="shop_pincode"
                                        value="{{ $businessDetails->shop_pincode }}" name="shop_pincode">
                                </div>
                                <div class="form-group">
                                    <label for="shop_mobile">Shop Mobile</label>
                                    <input type="text" class="form-control" id="shop_mobile"
                                        value="{{ $businessDetails->shop_mobile }}" name="shop_mobile">
                                </div>
                                <div class="form-group">
                                    <label for="shop_website">Shop Website</label>
                                    <input type="text" class="form-control" id="shop_website"
                                        value="{{ $businessDetails->shop_website }}" name="shop_website">
                                </div>
                                <div class="form-group">
                                    <label for="shop_email">Shop Email</label>
                                    <input type="text" class="form-control" id="shop_email"
                                        value="{{ $businessDetails->shop_email }}" name="shop_email">
                                </div>
                                <div class="form-group">
                                    <label for="address_proof">Address Proof</label>
                                    <select name="address_proof" id="">
                                        <option value="Passport">Passport</option>
                                        <option value="Voting Card">Voting Card</option>
                                        <option value="PAN">PAN</option>
                                        <option value="Driving License">Driving License</option>
                                        <option value="Aadhar Card">Aadhar Card</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address_proof_image">Upload Address Proof Image</label>
                                    <input type="file" class="form-control" name="address_proof_image">
                                    @if (!empty($businessDetails['address_proof_image']))
                                        <a href="{{ url(Auth::guard('admin')->user()->image) }}">View Address Proof
                                            Image</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="business_license_number">Business License Number</label>
                                    <input type="text" class="form-control" id="business_license_number"
                                        value="{{ $businessDetails->business_license_number }}"
                                        name="business_license_number">
                                </div>
                                <div class="form-group">
                                    <label for="gst_number">Gst Number</label>
                                    <input type="text" class="form-control" id="gst_number"
                                        value="{{ $businessDetails->gst_number }}" name="gst_number">
                                </div>
                                <div class="form-group">
                                    <label for="pan_number">Pan Number</label>
                                    <input type="text" class="form-control" id="pan_number"
                                        value="{{ $businessDetails->pan_number }}" name="pan_number">
                                </div>




                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                    BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection
