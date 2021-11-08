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
                <h3 class="card-title">supplier</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($supplier)? route('supplier.update',$supplier->id):route('supplier.store') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @isset($supplier)
                    @method('PUT')
                    @endisset
                    <div class="form-group">
                        <label class="form-label" for="name">Name </label>
                        <input type="text" class="form-control" name="first_name" id="name" required
                            value="{{ isset($supplier)?$supplier->first_name:''}}" placeholder=" Enter First Name">
                    </div>
                    
                     <div class="form-group">
                        <label class="form-label" for="name">Email </label>
                        <input type="email" class="form-control" name="email" id="name" required
                            value="{{ isset($supplier)?$supplier->email:''}}" placeholder=" Enter Email">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required
                            value="{{ isset($supplier)?$supplier->password:''}}" placeholder=" Enter password">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Phone </label>
                        <input type="text" class="form-control" name="mobilenumber" id="name"
                            value="{{ isset($supplier)?$supplier->mobilenumber:''}}" placeholder=" Enter Mobile Number">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Address </label>
                        <input type="text" class="form-control" name="address" id="name"  
                            value="{{ isset($supplier)?$supplier->address:''}}" placeholder=" Enter Address">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="name">Tax Number</label>
                        <input type="text" class="form-control" name="fax_number" id="name" 
                            value="{{ isset($supplier)?$supplier->fax_number:''}}" placeholder=" Enter Fax Number">
                    </div>
                    <div class="form-group mb-0">
                        <div class="checkbox checkbox-secondary">
                            <button type="submit"
                                class="btn btn-primary ">{{ isset($supplier)? 'Update':'Save'}}</button>
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

