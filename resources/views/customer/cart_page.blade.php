@extends('admin.layout.app')
@section('content')
<style type="text/css">
        .thead th,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: white;
        }

        .thead,
        .card-header {
            background-color: rgb(236, 96, 127);
        }
        .total{
            font-size:23px;
        }
        </style>
<div class="container my-4">
    {{-- main card showing all order --}}
    <div class="card">
        <div class="card-header" style="background-color:rgb(236, 96, 127)

        ">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                    </div>
                    <div class="col-2">
                        <a href="/customer/suppliers" class="btn" style="background-color: white;color:black
                        ">Order for another supplier</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- inner order card   --}}
            @php $id_array = [];
                $total = 0;

                
            @endphp

            
            @foreach($suppliers as $sup)


                @php
                    $carts = App\Models\Cart::where('supplier_id',$sup->id)->where('customer_id',auth()->user()->id)->get();
                    $prod_ids = [];
                    
                    $minqty = [];
                    $min = 0;
                    $all = [];
                    $allqty = [];


                    foreach($carts as $cart){
                        array_push($prod_ids,$cart->product_id);
                        array_push($all,$cart->total);
                        array_push($allqty,$cart->qty);

                        

                        if($cart->min_qty != NULL){
                            $min = $cart->min_qty;
                        }
                        array_push($minqty,$min);

                    }
                    
                  
                   

                @endphp
            @if(count($carts) > 0)
            <div class="card">
                @if(!in_array($sup->id,$id_array))
                <div class="card-header" style="background-color: rgb(236, 96, 127) ">
                        <section class="col-md-12">
                            <div class="row">
                                <div class="col-9 my-4">
                                    <table class="">
                                        <thead>

                                            <tr>
                                                <td class="text-right">
                                                    <h5 class="total">Supplier : </h5>
                                                </td>
                                                <td class="text-left">
                                                    <h6 class="total"> {{$sup->first_name}} {{$sup->last_name}} </h6>
                                                </td>
                                            </tr>
                                            
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-3 my-4">
                                    @php $c = App\Models\Cart::where('supplier_id',$sup->id)->where('customer_id',auth()->user()->id)->get();
                                    $total = 0;
                                        foreach($c as $data){
                                            $total = $total + $data->total;
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <h4 class="total">Total: <span>{{$total}} €</span>
                                            </h4>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </section>
                    </div>

                <div class="card-header" style="background-color: rgb(236, 96, 127) ">
                    <div class="col-12">
                    <div class="row">
                        <div class="col-2 heading">#</div>
                        <div class="col-2 heading">Product Name</div>
                        <div class="col-2 heading">Required Quantity</div>
                        <div class="col-2 heading">Minimum Quantity</div>

                        <!-- <div class="col-2 heading">Supplier</div> -->
                        <!-- <div class="col-2 heading">Unit</div> -->
                        <div class="col-2 heading">Total</div>
                        <div class="col-2 heading">Action</div>

                    </div>
                </div>
                </div>

                @endif
                @php $j = 1; @endphp

                <div class="card-body">
                    <div class="col-12">
                    @for($i = 0; $i < count($prod_ids); $i++)
                    @php $prod = App\Models\Product::find($prod_ids[$i]); @endphp
                    <div class="row mb-2">
                        <div class="col-2">{{$j++}}</div>

                        <div class="col-2">{{ $prod->name }}</div>
                        <div class="col-2">{{ $allqty[$i] }}</div>
                       
                        <div class="col-2">{{ $minqty[$i] }}</div>
                       
                        <!-- <div class="col-2">{{ $sup->first_name }}  {{ $sup->last_name }}</div> -->
                        <!-- <div class="col-2">
                        {{ $prod->unit->name }}
                        </div> -->
                        <div class="col-2">
                        {{ $all[$i] }} €
                        </div>
                        <div class="col-2">
                        <a href="{{route('remove_item',$cart->id)}}"><i style="color:red" class="fa fa-times"></i></a>
                        </div>
                    </div>
                    @endfor

                </div>

                </div>
                
                <div class="card-footer">
                       <div class=" d-flex flex-col-reverse float-right">
                        <a href="/customer/suppliers" style="background:orange;color:white" class="btn mx-1 ">modifiy</a>
                        <button onclick="confirm({{$sup->id}})" style="background:green;color:white" class="btn mx-1 ">confrim</button>

                       </div>
                </div>
               
            </div>
            @endif
           
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>


                            function confirm(id){


                                
                                $.ajax({
                                    "url" : "{{ route('confirm_order') }}",
                                    "method" : "POST",
                                    "type" : "json",
                                    "data" : {
                                        id:id,
                                        _token:"{{ csrf_token() }}"

                                    },
                                    success: function(data){
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Your Order is confirmed',
                                            text: "Your Order Id is "+data.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });

                                        window.location = "/customer/cart_page";



                                    }
                                });


                            }



                        </script>

            @endforeach
            {{-- iner card end --}}


        {{-- iner card end --}}


        </div>



    </div>
</div>


@endsection
