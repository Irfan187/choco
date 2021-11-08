
@extends('admin.layout.app')
@section('content')

        <div class="row">

            @foreach ($suppliers as $supplier)
            @if($supplier->isActive == 1)
            <div class="col-xl-4">
                @php
                $products=App\Models\Product::where('supplier_id',$supplier->id)->get();
                $cartcheck2= App\Models\Order::where('customer_id', auth()->user()->id)->where('supplier_id',$supplier->id)
                ->where('status','Not Confirmed')
                ->first();
                @endphp
                @if(count($products) <= 0)
                  <a href="#" onclick='alert("No product registered against this supplier");'>  
                @elseif(!empty($cartcheck2))
                <a href="#" onclick='alert("You have already a Not Confirmed Order for this supplier");'>  
                @else
                <a href="{{route('supplierdetails', $supplier->id)}}">  
                @endif
   
            <div class="card m-b-20">
                    <div class="card-header">
                        <center>
                        <h3 class="card-title text-center">{{$supplier->first_name}} {{$supplier->last_name}}</h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="row">
                           
                            <?php
                        $names =[]; //ng nae a gae samajh
                           $categories=App\Models\Product::where('supplier_id',$supplier->id)->pluck('category_id');
                           foreach($categories as $category)
                           {
                              $name= App\Models\Category::find($category);
                              if(!in_array($name,$names)){
                                array_push($names,$name);
                               }
                              
                           }
                            ?>
                            <div class="col">

                                @foreach($names as $name)
                                <span class="badge badge-success">{{ $name->name }}</span>
                                @endforeach

                            </div>
                        </div>


                        <br>
                        <!-- <div class="row">
                            <div class="col-12 text-center">
                                <button class="btn btn-danger"
                                    >Shop</button>
                            </div>
                        </div> -->
                    </div>
                </div></a>

            </div>
            @endif
            @endforeach

        </div>
@endsection
