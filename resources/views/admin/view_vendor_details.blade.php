@extends('admin.layout.layout');
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="text-center"><a href="{{ url('admin/admins/vendor') }}">Back</a></div>
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Personal Details</p>
                            <p class="font-weight-bold"><span>Name: </span> <span>{{ $vendorDetails->name }}</span></p>
                            <p class="font-weight-bold"><span>Address</span> <span>{{ $vendorDetails->address }}</span></p>
                            <p class="font-weight-bold"><span>City:</span> <span>{{ $vendorDetails->city }}</span></p>
                            <p class="font-weight-bold"><span>State:</span> <span>{{ $vendorDetails->state }}</span></p>
                            <p class="font-weight-bold"><span>Country:</span> <span>{{ $vendorDetails->country }}</span>
                            </p>
                            <p class="font-weight-bold"><span>Pincode</span> <span>{{ $vendorDetails->pincode }}</span>
                            </p>
                            <p class="font-weight-bold"><span>Mobile:</span> <span>{{ $vendorDetails->mobile }}</span></p>
                            <p class="font-weight-bold"><span>Profile Image </span><span><a
                                        href="{{ url($profileImage) }}">View</a></span></p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Business Details</p>
                            <p class="font-weight-bold"><span>Shop Name: </span>
                                <span>{{ $businessDetails->shop_name }}</span></p>
                            <p class="font-weight-bold"><span>Shop Address</span>
                                <span>{{ $businessDetails->shop_address }}</span></p>
                            <p class="font-weight-bold"><span>Shop City:</span>
                                <span>{{ $businessDetails->shop_city }}</span></p>
                            <p class="font-weight-bold"><span>Shop State:</span>
                                <span>{{ $businessDetails->shop_state }}</span></p>
                            <p class="font-weight-bold"><span>Shop Country:</span>
                                <span>{{ $businessDetails->shop_country }}</span></p>
                            <p class="font-weight-bold"><span>Shop Pincode</span>
                                <span>{{ $businessDetails->shop_pincode }}</span></p>
                            <p class="font-weight-bold"><span>Mobile:</span>
                                <span>{{ $businessDetails->shop_mobile }}</span></p>
                            <p class="font-weight-bold"><span>Shop Website:</span>
                                <span>{{ $businessDetails->shop_website }}</span></p>
                            <p class="font-weight-bold"><span>Address Proof:</span>
                                <span>{{ $businessDetails->address_proof }}</span> <span><a
                                        href="{{ url($businessImage) }}">View</a></span></p>
                            <p class="font-weight-bold"><span>Business License Number:</span>
                                <span>{{ $businessDetails->business_license_number }}</span></p>
                            <p class="font-weight-bold"><span>Gst Number:</span>
                                <span>{{ $businessDetails->gst_number }}</span></p>
                            <p class="font-weight-bold"><span>Pan Number:</span>
                                <span>{{ $businessDetails->pan_number }}</span></p>



                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Bank Details</p>
                            <p class="font-weight-bold"><span>Account Name: </span> <span>{{ $bankDetails->account_name}}</span></p>
                            <p class="font-weight-bold"><span>Bank Name</span> <span>{{ $bankDetails->bank_name }}</span></p>
                            <p class="font-weight-bold"><span>Account Number:</span> <span>{{ $bankDetails->account_number }}</span></p>
                            <p class="font-weight-bold"><span>Bank Ifsc Code:</span> <span>{{ $bankDetails->bank_ifsc_code }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
