@extends('admin.layout.app')
@section('content')
    <div class="container my-4">

        {{-- <div class="items">

                <div class="card-body"> <img class="logo" src="{{asset('images/products/163515867460158.jpeg')}}"> </div>


                <div class="card-body"> <img class="logo" src="{{asset('images/royalbombsGOLD100x100_75x.png')}}"> </div>

            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/yahoo.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/amazon.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/48/000000/netflix.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/ios-filled/100/000000/mac-os.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/48/000000/dell--v1.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/hp.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/ebay.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/ibm.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/sap.png"> </div>
            </div>
            <div class="card">
                <div class="card-body"> <img class="logo" src="https://img.icons8.com/color/100/000000/ebay.png"> </div>
            </div>
        </div> --}}
        <section class="items slider">
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">

                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>
            <div class="slide text-center">
                <a href="">
                    <img src="{{ asset('images/royalbombsGOLD100x100_75x.png') }}">
                    <h3>name</h3>
                </a>
            </div>

        </section>
    </div>

    <div class="table my-4">
        <div class="table-responsive">
            <table class="table table-bordered border-top mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Colin Carr</td>
                        <td>Accountant</td>
                        <td>colin@gmail.com</td>
                        <td><a href="#" class="btn btn-success btn-sm">Add to cart</a></td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Alison Fraser</td>
                        <td>Content Writer</td>
                        <td>alison@gmail.com</td>
                        <td><a href="#" class="btn btn-success btn-sm">Add to cart</a></td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Lily Ogden</td>
                        <td>Sr.Designer</td>
                        <td>lily@gmail.com</td>
                        <td><a href="#" class="btn btn-success btn-sm">Add to cart</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>



@endsection
