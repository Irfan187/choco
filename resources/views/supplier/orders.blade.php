


   <div class="card-header">
       <div class="card-title">{{$view}}</div>
       <div class="col-md-12">


       </div>
   </div>
   <div class="card-body">
       <div class="table-responsive">
           @include('message')
           <table id="example" class="table table-striped table-bordered">
               <thead>
                   <tr>
                       <th class="wd-15p">Order Number</th>
                       <th class="wd-10p">Product</th>
                       <th class="wd-10p">Price</th>
                       <th class="wd-10p">Qty</th>
                       <th class="wd-10p">Min Qty</th>
                       <th class="wd-10p">Total</th>
                       <th class="wd-10p">Unit</th>
                       <th class="wd-10p">Supplier</th>
                       <th class="wd-10p">Customer</th>
                       <th class="wd-10p">Action</th>



                   </tr>
               </thead>
               <tbody>
                   @foreach ($orders as $order)
                   <tr>
                       <td>{{ $order->order_number }}</td>
                       <?php
                            $products=[];
                            $prod_ids = json_decode($order->product_id);
                            foreach($prod_ids as $id)
                            {
                                $product = App\Models\Product::find($id);
                                array_push($products,$product);
                            }
                       ?>
                     <td>
                         @foreach($products as $product)
                         {{$product->name}}<br>
                         @endforeach
                     </td>
                       @isset($order->price)
                       <td>{{ $order->price }}</td>
                       @else
                       <td>-</td>
                       @endisset
                       <td>{{ $order->qty }}</td>
                       @if(!empty($order->min_qty))
                       <td>{{ $order->min_qty }}</td>
                       @else
                       <td>-</td>
                       @endif
                       <td>{{ $order->total}}</td>
                       @isset($order->unit)
                       <td>{{ $order->unit }}</td>
                       @else
                       <td>-</td>
                       @endisset
                       <?php
                      $supplier= App\Models\User::role('Supplier')->find($order->supplier_id);
                      $customer=App\Models\User::role('Customer')->find($order->customer_id);
                       ?>
                       <td>{{ $supplier->first_name }} {{ $supplier->last_name }}</td>
                       <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>

                        <td>
                            <span
                            class="label label-pill label-success" style="font-size:13px;">{{ 'Confirmed' }}
                            </span>
                       </td>

                   </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
   </div>
