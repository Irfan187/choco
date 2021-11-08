@extends('admin.layout.app')
@section('content')
<style>
    input {
        /* background: white;
        border:none; */
    }

    .card {
        background: white;
    }

    table {
        background: white;
    }
</style>

<div class="container my-4">
    <section>
        <h2>Supplier: {{ $supplier->first_name }} {{ $supplier->last_name }}</h2>
    </section>
</div>
@csrf
<div style="margin-top:20px;"></div>
@foreach($categories as $category)
@php
$products=App\Models\Product::where(['supplier_id'=>$supplier->id,'category_id'=>$category->id])->with('unit')->orderby('index','asc')->get();
@endphp
@if(count($products) > 0)
<center>
    <img src="{{asset('/images/Category/'. $category->image)}}" alt="" height="120" width="120"
        style="border-radius:50%;margin-bottom:20px;">
    <h3>{{$category->name}} </h3>
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
                    <th>Select Product</th>
                </tr>
            </thead>
            <tbody id='table-body'>
                @foreach($products as $product)
                <tr>
                    <th width="40px">{{ $loop->index+1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->unit->name }}</td>
                    <td>
                        <input id="price{{$product->id}}" type="number" style="width:90px;border:none"
                            value="{{ $product->price }}" min="1">
                    </td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <input id="total{{$product->id}}" type="number" style="width:90px;border:none"
                            value="{{ $product->price }}" min="1">
                    </td>
                    <td>
                        <input id="qty{{$product->id}}" onkeyup="calc({{$product->id}})" type="number"
                            style="width:40px;" value="1" min="1"><br><br>
                        @if($product->min_req_qty == 1)
                        <input type="checkbox" id="min_qty{{$product->id}}" onclick="minQuantity({{ $product->id}})"
                            style="width:40px;border:none" name="min_qty"> Min
                        Quantity<br><br>
                        <div id="showqty{{$product->id}}" style="display:none">
                            <input id="qty1{{$product->id}}" type="number" size="5" style="width:40px" value="0"
                                min="0">
                        </div>
                        @endif
                    </td>
                    @php
                    $cartcheck=
                    App\Models\Cart::where('customer_id',Auth::id())->where('product_id',$product->id)->first();
                    @endphp
                    <td>
                        @if(!empty($cartcheck))
                        <input type="checkbox" name="checked[]" id="checked{{$product->id}}" value="{{$product->id}}"
                            onclick="sessionAddToCart({{$product->id}},{{$category->id}},{{ $supplier->id }})" checked>
                        @else
                        <input type="checkbox" name="checked[]" id="checked{{$product->id}}" value="{{$product->id}}"
                            onclick="sessionAddToCart({{$product->id}},{{$category->id}},{{ $supplier->id }})">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            @php
            $cartcheck2=
            App\Models\Cart::where(['customer_id'=>Auth::id(),'supplier_id'=>$supplier->id,'category_id'=>$category->id])->get();
            @endphp
            <tfoot>
                <tr>
                    <td colspan="8">
                        @if(count($cartcheck2) > 0)
                        <a href="{{route('add_to_cart')}}" style="background:#ec607f;color:white" id="addtocart"
                            class="btn add-to-cart-btn">Update cart</a>
                        @else
                        <a href="{{route('add_to_cart')}}" style="background:#ec607f;color:white" id="addtocart"
                            class="btn add-to-cart-btn">Add to cart</a>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endif
@endforeach

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function calc(id){
                                var a = document.getElementById('qty'+id).value;
                                var b = document.getElementById('price'+id).value;
                                var c = parseInt(a) * parseInt(b);
                                $('#total'+id).val(c);
                            }
                            function minQuantity(id){
                                var checkbox = document.getElementById('min_qty'+id);
                                if(checkbox.checked) {
                                    document.getElementById("showqty"+"{{   $product->id;}}").style.display = "block";
                                }else{
                                    document.getElementById("showqty"+"{{   $product->id;}}").style.display = "none";
                                }
                            }

                            function sessionAddToCart(id,cat_id,sup_id){
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
@endsection
