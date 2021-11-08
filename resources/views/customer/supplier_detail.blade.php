@extends('admin.layout.app')
@section('content')
<style>
    input{
        /* background: white;
        border:none; */
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
    @csrf
    <div style="margin-top:20px;"></div>

@foreach($categories as $category)
                @php
                 
                 $products= App\Models\Product::where('supplier_id', $supplier->id)->where('category_id',$category->id)->with('unit')->orderby('index','asc')->get();

                 @endphp
    @if(count($products) > 0)
    <center>
    <img src="{{asset('/images/Category/'. $category->image)}}" alt="" height="120" width="120" style="border-radius:50%;margin-bottom:20px;">
     <h3>&emsp;{{$category->name}} </h3>
    </center>
    

    <div class="table my-4 card">
        <div class="table-responsive">
            <table class="table table-bordered border-top mb-0" style="background:white;" id="my-table">
                <thead>
                    <tr>
                        <th width="40px">#</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price/unit (€)</th>
                        <th>Available Quantity</th>
                        <th>Total (€)</th>
                        <th>Required Quantity</th>
                        <th>Order</th>

                        <th>Select Product</th>

                    </tr>
                </thead>
                <tbody id='table-body'>
                   
                @foreach($products as $product)
                @php
                $cartcheck= App\Models\Cart::where('customer_id', auth()->user()->id)->where('product_id',$product->id)->first();
                              

                 @endphp
          
                    <tr >
                        <th width="40px">{{ $loop->index+1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->unit->name }}</td>
                        <td><input id="price{{$product->id}}" type="number" style="width:90px" value="{{ $product->price }}" min="1"> </td>
                        <td>{{ $product->quantity }}</td>
                        <td><input id="total{{$product->id}}" type="number" style="width:90px"  value="{{ $product->price }}" min="1"></td>
                        <td>
                           
                        <input id="qty{{$product->id}}" type="number" style="width:40px"  value="1" min="1"><br><br>
                            
                            @if($product->min_req_qty == 1)
                             <input type="checkbox" id="min_qty{{$product->id}}" style="width:40px" name="min_qty"> Min Quantity<br><br>
                            <div id="showqty{{$product->id}}" style="display:none">
                                <input id="qty1{{$product->id}}" type="number" size="5" style="width:40px;" value="0" min="0">
                                
                               
                            </div>
                            @endif
                           
                        </td>
                        <td>
                            <span class="badge badge-success">{{$product->index}}</span>
                        </td>
                        <td>
                            @if(!empty($cartcheck))
                            <input type="checkbox" name="checked[]" id="checked{{$product->id}}" value="{{$product->id}}" onclick="sessionaddtocart({{$product->id}},{{$category->id}})" checked>
                            @else
                            <input type="checkbox" name="checked[]" id="checked{{$product->id}}" value="{{$product->id}}" onclick="sessionaddtocart({{$product->id}},{{$category->id}})">
                            @endif
                        </td>               
                        
                    </tr>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                            var id = <?php echo $product->id; ?>;
                            var catid = <?php echo $category->id; ?>;
                            var sup_id = <?php echo $supplier->id; ?>;
                            

                            $('#qty'+id).keyup(function(){
                                var a = document.getElementById('qty'+id).value;
                                var b = document.getElementById('price'+id).value;
                                var c = parseInt(a) * parseInt(b);
                                console.log(a + "  " +b + " " + c);
                                $('#total'+id).val(c);
                            });

                            $('#qty'+id).keydown(function(){
                                var a = document.getElementById('qty'+id).value;
                                var b = document.getElementById('price'+id).value;
                                var c = parseInt(a) * parseInt(b);
                                console.log(a + "  " +b + " " + c);
                                $('#total'+id).val(c);
                            });
                            
                            

                            $('#min_qty'+<?php echo $product->id;?>).change(function () {
                                if(this.checked) {
                                    console.log(id)
                                    document.getElementById("showqty"+<?php echo $product->id;?>).style.display = "block";
                                }else{
                                    console.log(id+ " hi")
                                    document.getElementById("showqty"+<?php echo $product->id;?>).style.display = "none";
                                }
                            
                            });


                            function sessionaddtocart(id,cat_id){
                                // alert(catid)
                                var total = $('#total'+id).val();
                                var qty = $('#qty'+id).val();
                                var qty1 = $('#qty1'+id).val();

                                var checked = "";

                                if($("#checked"+id).prop('checked') == true){
                                    checked = "1";
                                }else{
                                    checked = "0";
                                    alert('Product Deleted from Cart');
                                }

                                $.ajax({
                                    "url" : "{{ route('session_add_to_cart') }}",
                                    "method" : "GET",
                                    "type" : "json",
                                    "data" : {
                                        p_id:id,
                                        s_id:sup_id,
                                        total:total,
                                        qty:qty,
                                        qty1:qty1,
                                        checked:checked,
                                        catid:cat_id,
                                    },
                                    
                                        
                                    
                                });
                                
                            }

                         

                            
                            

                           
                            
                            
                        </script>
                @endforeach
                </tbody>
                @php $cartcheck2= App\Models\Cart::where('customer_id', auth()->user()->id)->where('supplier_id',$supplier->id)
                ->where('category_id',$category->id)->get(); @endphp

                <tfoot>
                    <tr>
                        @if(count($cartcheck2) > 0)
                        <td><a href="{{route('add_to_cart')}}" style="background:#ec607f;color:white" id="addtocart" class="btn add-to-cart-btn">Update cart</button></td>
                        @else
                        <td><a href="{{route('add_to_cart')}}" style="background:#ec607f;color:white" id="addtocart" class="btn add-to-cart-btn">Add to cart</button></td>
                        @endif
                    </tr>
                </tfoot>
            </table>
            
            </div>
            </div>
            @endif
            @endforeach
     
           



    
@endsection
