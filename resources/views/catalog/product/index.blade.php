<!-- 

 <div class="col-sm-4" style="margin-top:20px;"  >
 <form action="{{url('search')}}" method="POST" enctype="multipart/form-data">
 @csrf
        <input type="text" id="searchbar" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
</form>
</div> -->
           
 <div class="card-header">
    <div class="card-title">{{ $view}}</div>
    <div class="col-md-12">
        <div class="row pull-right">
        <div class="col-sm-4 " >
             <a  href="javascript:void(0);" onClick="printPage(printsection.innerHTML)" class="btn btn-primary text-white mr-5"><i class="fa fa-print"></i>
                report</a>
        </div>
        <div class="col-sm-4 " style="margin-left:10px;">
            <a href="{{ route($view.'.create') }}" class="btn btn-primary text-white mr-5"><i class="fa fa-plus"></i>
                {{ $view }}</a>
         </div>
       
              
        </div>
    </div>
</div>
<div class="row" style="margin-top:20px;margin-bottom:20px;">
    <div class="col-lg-8"></div>
    <div class="col-lg-3">
        <select name="cats" id="cat" class="form-control">
            @foreach($cats as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    
</div>
<div class="card-body">
    <div class="table-responsive">
        @include('message')
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="wd-25p">Image</th>
                    <th class="wd-15p">Name </th>
                    <th class="wd-15p">Price (€)</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-10p">Index</th>
                    <th class="wd-10p">Action</th>

                   


                </tr>
            </thead>
            <tbody>
                
                @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('images/Product/'.$product->image) }}" style="height: 80px; width:150px"
                            alt="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} {{'€'}}</td>

                    
                        {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#exampleModalLong">View modal</button> --}}
                        
                    
                    <td>
                        <a href="{{ route('product.status',$product->id) }}"><span
                                class="label label-pill label-{{ $product->isActive == 1?'success':'danger' }} mt-2" style="font-size:11px;">{{ $product->isActive == 1? trans('message.isActive.active'):trans('message.isActive.inactive') }}</span>
                        </a>
                    </td>
                    <td>
                            <span class="badge badge-success">{{$product->index}}</span>
                        </td> 
                    <td>
                        <div class="row">
                        <div class="col-sm-3"> 
                        <a type="button" data-toggle="modal" data-target="#Show{{ $product->id }}"><span
                                class="label label-pill label-success mt-2" style="font-size:11px;"><i class="fa fa-eye"></i> view</span>
                        </a>
                        </div>
                            <div class="col-sm-2">
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-edit text-white"></i></a>
                             </div>

                             <div class="col-sm-2">
                                    <form action="{{ route('product.destroy',$product->id) }}" method="POST" enctype="multipart/form-data"> 
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"></i></button>
                                    </form>
                            </div>
                        </div>   
                    </td>
                </tr>
                {{-- Show Modal --}}
                <div class="modal" id="Show{{ $product->id }}" role="dialog" aria-labelledby="exampleModalLongTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $product->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               
                            <div class="row">
                                            <div class="col-sm-5">
                                               <h6>Category</h6>  
                                            </div>
                                            <div class="col-sm-5">
                                            {{ $product->category->name }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                 <h6> Description </h6>
                                            </div>
                                            <div class="col-sm-5">
                                            {!! html_entity_decode($product->description) !!}
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-5">
                                                 <h6> Manufacturing Partner</h6>
                                            </div>
                                            <?php
                                            $manufacturer=App\Models\User::where('id', $product->manufacturing_partner_id)->first();
                                             ?>
                                            <div class="col-sm-5">
                                                {{$manufacturer->first_name}}  {{$manufacturer->last_name}}
                                           
                                            </div>
                                        </div>
                                      






                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="printsection" style="display:none">
    
        @if(count($products) == 0)
        <p>No product added in yet</p>
        @else
     
<div class="table-responsive">
        @include('message')

       
        <table id="example" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th class="wd-25p" style=' border: 1px solid black;' >Image</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Name </th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Price</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Quantity</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Category</th>
                   
                    <!-- <th class="wd-10p">Status</th> -->
                </tr>
            </thead>
            <tbody>
            <!-- <div  id=""> -->
               
                @foreach ($products as $product)
                <tr>
                    <td style=' border: 1px solid black;'><img src="{{ asset('images/Product/'.$product->image) }}" style="height: 80px; width:150px" alt="">
                    </td> 
                    <td  style=' border: 1px solid black;'>{{ $product->name }}</td>
                    <td style=' border: 1px solid black;'>{{ $product->price }}</td>
                    <td style=' border: 1px solid black;'>{{ $product->quantity }}</td>

                        @php
                            $category= App\Models\Category::find($product->category_id);
                            $category_name=$category->name;
                        @endphp

                   <td style=' border: 1px solid black;'>{{  $category_name  }}</td>
                </tr>
                
             
                @endforeach
                <!-- </div> -->
            </tbody>
        </table>
    </div>
</div>

@endif
<div id="users">


</div>

<script language="javascript">
function printPage(printContent) {
var display_setting="toolbar=yes,menubar=yes,";
display_setting+="scrollbars=yes,width=1000, height=1000, left=100, top=25";

var printpage=window.open("","",display_setting);
printpage.document.open();
printpage.document.write('<html><head><title>Print Page</title></head>');
printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent );
printpage.document.close();
printpage.focus();
}



// function search()  //
// {
//           var search_word=$("#searchbar").val();
//           alert(search_word);
//     $.ajax({
//             type:'GET',
//            {{--- url: "{{url('search')}}", --}}
//             data:{
//                search_word : search_word
//             },
//             success:function(data) {
//                 console.log(data);
//             document.getElementById("product-table").innerHTML = '' ;
//             data.forEach(function(value) 
//             {
//                $("#product-table").append("<tr><td style='border: 1px solid black;'>"+value.name+"</td><td style='border: 1px solid black;'>"+value.price+"</td></tr>");
//             });

//             }
//         });

// }


$('select').on('change', function() {
  var id = this.value;

  $.ajax({
            type:'GET',
            url: "{{route('getproducts')}}",
            data:{
               id : id
            },
            success:function(data) {
               
            var all_data = "";
            
            $('tbody').empty();

            data.forEach(function(value) 
            {
                var img = 'http://localhost:8000/images/Product/'+value.image;
               all_data +=
                    '<tr><td style=""><img src="'+img+'" style="height: 80px; width:150px" alt="">'
                    +'</td>'+
                    '<td style="">'+ value.name +'</td>'+
                    '<td style="">'+value.price+'</td>';
                    if(value.isActive == 0){
                        all_data+='<td> <span class="label label-pill label-danger" style="">In Active</span></td>';
                    }else{
                        all_data+='<td> <span class="label label-pill label-success" style="">Actice</span></td>';
                    }
                    

            

                    all_data+='<td><span class="badge badge-success">'+value.index+'</span></td> <td style=""><div class="row"><div class="col-sm-3"><a type="button" data-toggle="modal" data-target="#Show'+value.id+'"><span class="label label-pill label-success mt-2" style="font-size:11px;"><i class="fa fa-eye"></i> view</span></a></td></tr>'
                ;
            });

            $('tbody').append(all_data);
            // $('tbody').css('display','table');

            console.log(all_data)
            }
        });
});

</script>
</div>


    