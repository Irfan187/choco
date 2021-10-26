@extends('admin.layout.app')
@section('css')
<!-- file Uploads -->
<link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">customer</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($customer)? route('customer.update',$customer->id):route('customer.store') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @isset($customer)
                    @method('PUT')
                    @endisset
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            value="{{ isset($customer)?$customer->first_name:''}}" placeholder=" Enter first name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name"
                            value="{{ isset($customer)?$customer->last_name:''}}" placeholder=" Enter last name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ isset($customer)?$customer->email:''}}" placeholder=" Enter email">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            value="{{ isset($customer)?$customer->password:''}}" placeholder=" Enter password">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="franchise_name">Franchise Name</label>
                        <input type="text" class="form-control" name="franchise_name" id="franchise_name"
                            value="{{ isset($customer)?$customer->franchise_name:''}}" placeholder=" Enter Franchise name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="mobilenumber">Mobile Number</label>
                        <input type="text" class="form-control" name="mobilenumber" id="mobilenumber"
                            value="{{ isset($customer)?$customer->mobilenumber:''}}" placeholder=" Enter mobile number">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                            value="{{ isset($customer)?$customer->address:''}}" placeholder=" Enter address">
                    </div>

                 


                    <div class="form-group mb-0">
                        <div class="checkbox checkbox-secondary">
                            <button type="submit"
                                class="btn btn-primary ">{{ isset($customer)? 'Update':'Save'}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<!-- Inline js -->
<script src="{{asset('admin/assets/js/formelements.js')}}"></script>

<!-- file uploads js -->
<script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>

@endsection

