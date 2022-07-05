@extends('admin.layout.layout');
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-9 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ ucfirst($type) }}s</h4>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 0;
                                        @endphp
                                        @foreach ($admins as $admin)
                                            @php
                                                $x++;
                                            @endphp
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->mobile }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td><img src="{{ asset($admin->image) }}" /></td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input vendors"
                                                            {{($admin->status)?'checked':''}} id="inp-{{$admin->id}}" adm_id="{{$admin->id}}">
                                                        <label class="custom-control-label" for="inp-{{$admin->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (strtolower($type) == 'vendor')
                                                        <a href="{{ url('admin/view_vendor_details/' . $admin->id) }}"><span
                                                                class="mdi mdi-format-list-bulleted"
                                                                style="font-size: 25px"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
