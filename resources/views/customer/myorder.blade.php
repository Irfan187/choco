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

    .total {
        font-size: 23px;
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
                            <span class="fe fe-search" style="color:pink"></span>
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
        <div class="card" id="supplier{{ $order->supplier_id }}">
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
                                    <h4 class="total">Total: <span id="Ooldpr{{ $order->id }}">{{$order->total}}</span>€
                                    </h4>
                                </td>
                            </tr>
                        </div>
                    </div>
                </section>
            </div>
            <form method="post" action="{{ url('customer/order/modified') }}">
                @csrf
                <input type="hidden" name="price" value="" id="total1{{ $order->id }}">
                <div class="card-body">
                    <table class="table table-bordered text-center rounded-lg">
                        <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Price/unit</th>
                                <th scope="col">Required Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Minimum Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1;$k = 0; @endphp
                            @foreach($prod_ids as $id)
                            @php $prod = App\Models\Product::find($id); @endphp
                            <tr>
                                <input type="hidden" value="{{ $prod->id }}" name="product_id[]">
                                <td scope="row">{{ $i++ }}</td>
                                <td scope="row">{{ $prod->name }}</td>
                                <td scope="row">{{$prod->unit->name}}</td>
                                <td scope="row"><span id="Pprice{{ $prod->id }}">{{ $prod->price }}</span> €</td>
                                @if($order->status == "Not confirmed")
                                <td>
                                    <input id="Pqty{{$prod->id}}"
                                        onkeyup="calc({{$prod->id}},{{ $qtys[$k] }},{{ $order->id }})" type="number"
                                        style="width:40px;" name="qty[]" value="{{ $qtys[$k] }}" min="1">
                                </td>
                                @else
                                <td scope="row">{{$qtys[$k]}}</td>
                                @endif
                                <td> <span id="total{{ $prod->id }}">{{ $qtys[$k] * $prod->price }}</span> €</td>
                                <td scope="row">{{$min_qtys[$k]}}</td>
                                <td><a href="{{route('remove_item_order',[$order->id,$prod->id])}}"><i style="color:red"
                                            class="fa fa-times"></i></a></td>
                            </tr>
                            @php $k++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-10 float-left"></div>
                            <div class="col-2 float-right text-right">
                                @if($order->status == "Not confirmed")
                                <input type="hidden" value="{{ $order->supplier_id }}" name="order_id">
                                <input type="submit" class="btn btn-success" value="Save Changes">
                                @else
                                <span class="btn btn-success ">{{ $order->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @endforeach
</div>
<script>
    function calc(id,val,order){
        console.log(id+' '+val+' '+order);
        var a = document.getElementById('Pqty'+id).value;

        var b = document.getElementById('Pprice'+id).innerHTML;
        var c = parseInt(a) * parseInt(b);
        var d = document.getElementById('Ooldpr'+order).innerHTML;

        $('#total'+id).html(c);

        var price= (parseInt(d) - (parseInt(val) * parseInt(b))) + parseInt(c)
        $('#total1'+order).val(price);
        // console.log(document.getElementById('Ooldpr'+order))
        // document.getElementById('Ooldpr'+order).innerHTML = price;
    }
</script>
@endsection
