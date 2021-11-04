<!-- <div class="col-sm-4" style="margin-top:20px;"  >
 <form action="{{url('customer/search')}}" method="POST" enctype="multipart/form-data">
 @csrf
        <input type="text" id="searchbar" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
</form>
</div> -->

<div class="card-header">
    <div class="card-title">Customers</div>
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
<div class="card-body">
    <div class="table-responsive">
        @include('message')
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="wd-15p">First Name</th>
                    <th class="wd-10p">Last Name</th>
                    <th class="wd-10p">Email</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-10p">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>             
                    <td>
                     <a href="{{ route('customer.status',$customer->id) }}"><span
                                class="label label-pill label-{{ $customer->isActive == 1?'success':'danger' }} mt-2" style="font-size:11px;">{{ $customer->isActive == 1? trans('message.isActive.active'):trans('message.isActive.inactive') }}</span>
                        </a>  
                    </td>                   
                    {{-- <td>
                     <a href="{{ route('customer.status',$customer->id) }}"><span
                                class="label label-pill label-{{ $customer->isActive == 1?'success':'danger' }} mt-2">{{ $customer->isActive == 1? trans('message.isActive.active'):trans('message.isActive.inactive') }}</span>
                        </a>  
                    </td> --}}
                    <td>
                        <div class="row">
                        <div class="col-sm-3">
                        <a type="button" data-toggle="modal" data-target="#Show{{ $customer->id }}"><span
                        class="label label-pill label-success mt-2"><i class="fa fa-eye"></i> view</span>
                        </a>
                    </div>
                           <div class="col-sm-2">
                            <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit text-white"></i></a>
                            </div>
                              <div class="col-sm-2">
                                    <form action="{{ route('customer.destroy',$customer->id) }}" method="POST" enctype="multipart/form-data"> 
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"></i></button>
                                    </form>
                                </div>
                        </div>
                                
                    </td>
                </tr>



                {{-- Show Modal --}}
                <div class="modal" id="Show{{ $customer->id }}" role="dialog" aria-labelledby="exampleModalLongTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $customer->first_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-header">
                                        Mobile Number
                                    </div>
                                    <div class="card-body">
                                    {{ $customer->mobilenumber }}
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">Address</div>
                                    <div class="card-body">

                                
                                        {{  $customer->address }}
                                    </div>
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
    
        @if(count($customers) == 0)
        <p>No customer registered yet</p>
        @else
     
<div class="table-responsive">
        @include('message')

       
        <table id="example" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th class="wd-25p" style=' border: 1px solid black;' >First Name</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Last Name </th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Email</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Mobile Number</th>
                    <th class="wd-15p" style=' border: 1px solid black;' >Address</th>
                   
                </tr>
            </thead>
            <tbody>
            
               
                @foreach ($customers as $customer)
                <tr>
                    <td style=' border: 1px solid black;'>{{  $customer->first_name }}</td>
                    <td style=' border: 1px solid black;'>{{  $customer->last_name}}</td>
                    <td style=' border: 1px solid black;'>{{  $customer->email }}</td>
                    <td style=' border: 1px solid black;'>{{  $customer->mobilenumber}}</td>
                    <td style=' border: 1px solid black;'>{{  $customer->address}}</td>
                </tr>
                
             
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endif
</div>



<script language="javascript">
function printPage(printContent) {
var display_setting="toolbar=yes,menubar=yes,";
display_setting+="scrollbars=yes,width=1000, height=1000, left=100, top=25";


var printpage=window.open("","",display_setting);
printpage.document.open();
printpage.document.write('<html><head><title>Print Page</title></head>');
printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>');
printpage.document.close();
printpage.focus();
}
</script>
    

