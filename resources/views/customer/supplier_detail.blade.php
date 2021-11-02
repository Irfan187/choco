@extends('admin.layout.app')
@section('content')
<style>
    input{
        background: white;
        border:none;
    }
    .card{
        background: white;
    }
    table{
        background:white;
    }
</style>
    
    <div class="container my-4">

        {{-- <div class="items">

                <div class="card-body"> <img class="logo" src="{{asset('images/products/163515867460158.jpeg')}}"> </div>


                <div class="card-body"> <img class="logo" src="{{asset('images/logo1.png')}}"> </div>

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
        <section>
            
                <h2>Supplier: {{ $supplier->first_name }} {{ $supplier->last_name }}</h2>
            
        </section>
     
    </div>
    <div style="margin-top:20px;"></div>

@foreach($categories as $category)
     <h3>&emsp; Category: {{$category->name}} </h3>

    <div class="table my-4 card">
        <div class="table-responsive">
            <table class="table table-bordered border-top mb-0" style="background:white;" id="my-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price/unit</th>
                        <th>Available Quantity</th>
                        <th>Total</th>
                        <th>Required Quantity</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody id='table-body'>
                    @php
                 
                    $products= App\Models\Product::where('supplier_id', $supplier->id)->where('category_id',$category->id)->with('unit')->get();

                    @endphp
                
                @foreach($products as $product)
              
          
                    <tr >
                        <th>{{ $loop->index+1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->unit->name }}</td>
                        <td><input id="price{{$product->id}}" type="number" style="width:40px" value="{{ $product->price }}" min="1" readonly> €</td>
                        <td>{{ $product->quantity }}</td>
                        <td><input id="total{{$product->id}}" type="number" style="width:40px" value="{{ $product->price }}" min="1" readonly>€</td>
                        <td>
                           
                            <input id="qty{{$product->id}}" type="number" style="width:40px" value="1" min="1" readonly>
                            <button class="plus" onclick="increment({{$product->id}})"><b>+</b></button>
                            <button class="minus" onclick="decrement({{$product->id}})"><b>-</b></button><br><br>
                            @if($product->min_req_qty == 1)
                             <input type="checkbox" id="min_qty{{$product->id}}" name="min_qty"> Min Quantity<br><br>
                            <div id="showqty{{$product->id}}" style="display:none">
                                <input id="qty1{{$product->id}}" type="number" size="5" style="width:40px;" value="0" min="0" readonly>
                                <button class="plus" onclick="increment1({{$product->id}})"><b>+</b></button>
                                <button class="minus" onclick="decrement1({{$product->id}})"><b>-</b></button>
                               
                            </div>
                            @endif
                           
                        </td>               
                        @if(empty($c))
                        <td><button onclick="addtocart({{$product->id}})" id="addtocart{{$product->id}}" class="btn add-to-cart-btn">Add to cart</button></td>
                        @else
                        <td><button  id="addtocart{{$product->id}}" class="btn add-to-cart-btn"><i class="fa fa-check"></i> Added</button></td>

                        @endif
                    </tr>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                            var id = <?php echo $product->id; ?>;
                            var sup_id = <?php echo $supplier->id; ?>;
                            


                            function increment(id) {
                                document.getElementById('qty'+id).stepUp();
                                var a = document.getElementById('qty'+id).value;
                                var b = document.getElementById('price'+id).value;
                                var c = parseInt(a) * parseInt(b);
                                console.log(a + "  " +b + " " + c);
                                $('#total'+id).val(c);

                            }
                            function decrement(id) {
                                document.getElementById('qty'+id).stepDown();
                                var a = document.getElementById('qty'+id).value;
                                var b = document.getElementById('price'+id).value;
                                var c = a * b;
                                $('#total'+id).val(c);

                            }

                            function increment1(id) {
                                document.getElementById('qty1'+id).stepUp();

                            }
                            function decrement1(id) {
                                document.getElementById('qty1'+id).stepDown();

                            }

                            $('#min_qty'+<?php echo $product->id;?>).change(function () {
                                if(this.checked) {
                                    console.log(id)
                                    document.getElementById("showqty"+<?php echo $product->id;?>).style.display = "block";
                                }else{
                                    console.log(id+ " hi")
                                    document.getElementById("showqty"+<?php echo $product->id;?>).style.display = "none";
                                }
                            
                            });

                         

                            function addtocart(id){

                                var total = $('#total'+id).val();
                                var qty = $('#qty'+id).val();
                                var qty1 = $('#qty1'+id).val();


                                $.ajax({
                                    "url" : "{{ route('add_to_cart') }}",
                                    "method" : "GET",
                                    "type" : "json",
                                    "data" : {
                                        p_id:id,
                                        s_id:sup_id,
                                        total:total,
                                        qty:qty,
                                        qty1:qty1,
                                    },
                                    success: function(data){
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Item added to cart successfully',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });

                                        location.reload();
                                        
                                    }
                                });

                                
                            }
                            

                           
                            
                            
                        </script>
                
                </tbody>
            </table>
            @endforeach
            </div>
            </div>
            @endforeach
     

   


    
@endsection
