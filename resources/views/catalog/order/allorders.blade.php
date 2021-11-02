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
    <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title">My Orders</h3>
                <div class="card-options">
                    <span class="input-group-btn mx-2">
                        <!-- <a class="btn">
                            <span class="fe fe-filter text-white" type="datepicker"></span>
                        </a> -->
                    </span>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search something..." name="s">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="fe fe-search" style="color:pink" ></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
           
            @foreach($orders as $order)
            @php
                    $prod_ids = json_decode($order->product_id);
                    $qtys = json_decode($order->qty);
                    $min_qtys = json_decode($order->min_qty);

                    $sup = App\Models\User::role('Supplier')->find($order->supplier_id);
                    $date = explode(" ",$order->created_at);
                    

                @endphp
            <section class="orderdetails my-2 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <section class="col-md-12">
                            <div class="row">
                                <div class="col-9">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                <th class="text-right px-2">
                                                    <h5>Order# : </h5>
                                                </th>
                                                <th class="text-left px-2">
                                                    <h6> {{$order->order_number}}</h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right px-2">
                                                    <h5>Supplier : </h5>
                                                </th>
                                                <th class="text-left px-2">
                                                    <h6> {{$sup->first_name}} {{$sup->last_name}} </h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right px-2">
                                                    <h5>Order Date : </h5>
                                                </th>
                                                <th class="text-left px-2">
                                                    <h6> {{ $date[0] }} </h6>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-3 my-4">
                                    <tr>
                                        <td>
                                            <h4  class="total">Total: <span>{{$order->total}} €</span>
                                            </h4>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center rounded-lg">
                            <thead class="thead">
                                <tr>
                                <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Price/unit</th>

                                    <th scope="col">Required Quantity</th>
                                    
                                    <th scope="col">Minimum Quantity</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            @php $i = 1;$k=0; @endphp
                                @foreach($prod_ids as $id)
                                @php $prod = App\Models\Product::find($id); @endphp
                                <tr>
                                <td scope="row">{{ $i++ }}</td>
                                    <td scope="row">{{ $prod->name }}</td>
                                    <td scope="row">{{$prod->unit->name}}</td>
                                    <td scope="row">{{ $prod->price }} €</td>

                                    <td scope="row">{{$qtys[$k]}}</td>
                                    <td scope="row">{{$min_qtys[$k]}}</td>
                                </tr>
                                @php $k++; @endphp
                                @endforeach
                            </tbody>
                         
                        </table>
                      <div id="radiobuttons">

                      </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-10 float-left"></div>
                                <div class="col-2 float-right text-right">
                                    <select name="ord_status" id="ord_status{{$order->id}}" class="form-control" >
                                        @if($order->status == "Confirmed")
                                        <option value="Confirmed" selected>Confirmed</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Pending">Pending</option>
                                        @elseif($order->status == "Shipped")
                                        <option value="Shipped" selected>Shipped</option>
                                        @elseif($order->status == "Pending")
                                        <option value="Confirmed" >Confirmed</option>
                                        <option value="Shipped" >Shipped</option>
                                        <option value="Pending" selected>Pending</option>
                                        @endif
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                function changeQty(value, order_id)
                {    
                    alert(order_id);
                    $.ajax
                                ({
                                    "url" : "{{ route('quantity.update') }}",
                                    "method" : "GET",
                                    "data" : {
                                       order_id:order_id,
                                       req_min_qty:value 
                                       
                                    },
                                    success: function(data)
                                    {
                                        console.log(data); 
                                    }
                                });  
                }

                       
                $('#ord_status'+<?php echo $order->id;?>).on('change', function() {

                                var status = $('#ord_status'+<?php echo $order->id;?>).val();
                                if(status=='Shipped')
                                {
                                    document.getElementById("radiobuttons").innerHTML = 
                                     '<input type="hidden" name="order_id" value="<?php echo $order->id;?>"><input type="radio" id="r_qty" name="shipped_with_min_qty" onclick="changeQty(this.value, <?php echo $order->id;?>)" value="0">'+
                                      '<label for="r_qty">&emsp;Required quantity</label><br>'+
                                      '<input type="radio" id="r_min_qty" name="shipped_with_min_qty" value="1" onclick="changeQty(this.value, <?php echo $order->id;?>)" >'+
                                      '<label for="r_min_qty">&emsp;Required minimum quantity</label><br>';
                                }
                               
                                $.ajax
                                ({
                                    "url" : "/order/status",
                                    "method" : "GET",
                                    "data" : {
                                       order_id:<?php echo $order->id;?> ,
                                       status:status
                                    },
                                    success: function(data)
                                    {
                                        console.log(data); 
                                    }
                                });  


                            });

                         






                           
            </script>
            @endforeach
           


    </div>

    {{$orders->links()}}
@endsection
