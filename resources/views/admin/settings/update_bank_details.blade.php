@extends('admin.layout.layout');
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Bank Details</h4>
                            <form class="forms-sample" method="post" action="{{ url('admin/update_vendor_details/bank') }}"
                                enctype="multipart/form-data">
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
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name"
                                        value="{{$bankDetails->account_name }}" name="account_name">
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name"
                                        value="{{$bankDetails->bank_name }}" name="bank_name">
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="number" class="form-control" id="account_number"
                                        value="{{$bankDetails->account_number }}" name="account_number">
                                </div>
                                <div class="form-group">
                                    <label for="bank_ifsc_code">Bank Ifsc Code</label>
                                    <input type="number" class="form-control" id="bank_ifsc_code"
                                        value="{{$bankDetails->bank_ifsc_code }}" name="bank_ifsc_code">
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
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ?? 2021. Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                    BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection
