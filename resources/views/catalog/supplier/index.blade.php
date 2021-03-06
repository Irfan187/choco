<!-- 
<div class="col-sm-4" style="margin-top:20px;"  >
 <form action="{{url('supplier/search')}}" method="POST" enctype="multipart/form-data">
 @csrf
        <input type="text" id="searchbar" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
</form>
</div> -->


<div class="card-header">
    <div class="card-title">Suppliers</div>
    <div class="col-md-12">
        <div class="text-right mr-5">
            <a href="{{ route($view.'.create') }}" class="btn btn-primary text-white mr-5"><i class="fa fa-plus"></i>
                {{ $view }}</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        @include('message')
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="wd-25p">Name</th>
                    <th class="wd-15p">Email</th>
                    <th class="wd-10p">Mobile Number</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-10p">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                   
                    <td>{{ $supplier->first_name }}  {{ $supplier->last_name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->mobilenumber }}</td>
                    <td>
                     <a href="{{ route('supplier.status',$supplier->id) }}"><span
                                class="label label-pill label-{{ $supplier->isActive == 1?'success':'danger' }} mt-2" style="font-size:11px;">{{ $supplier->isActive == 1? trans('message.isActive.active'):trans('message.isActive.inactive') }}</span>
                        </a>  
                    </td>

                    {{-- <td>
                        <a href="{{ route('supplier.status',$supplier->id) }}"><span
                                class="label label-pill label-{{ $supplier->isActive == 1?'success':'danger' }} mt-2" style="font-size:11px;">{{ $supplier->isActive == 1? trans('message.isActive.active'):trans('message.isActive.inactive') }}</span>
                        </a>
                    </td> --}}
                    <td>
                        <div class="row">
                        <div class="col-sm-4"> 
                        <a type="button" data-toggle="modal" data-target="#Show{{ $supplier->id }}"><span
                                class="label label-pill label-success mt-2" style="font-size:11px;"><i class="fa fa-eye"></i> view</span>
                        </a>
                        </div>

                            <div class="col-sm-3">
                                 <a href="{{ route('supplier.edit',$supplier->id) }}" class="btn btn-primary btn-sm"><i
                                  class="fa fa-edit text-white"></i></a>
                            </div>
                             <!-- <div class="col-sm-3">
                                    <form action="{{ route('supplier.destroy',$supplier->id) }}" method="POST" enctype="multipart/form-data"> 
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"></i></button>
                                    </form>
                            </div> -->
                        </div>
                    </td>
                </tr>



                {{-- Show Modal --}}
                <div class="modal" id="Show{{ $supplier->id }}" role="dialog" aria-labelledby="exampleModalLongTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $supplier->first_name }}    {{ $supplier->last_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               
                            <div class="row">
                                            <div class="col-sm-5">
                                               <h6>Address</h6>  
                                            </div>
                                            <div class="col-sm-5">
                                            {{ $supplier->address}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                 <h6> Fax Number </h6>
                                            </div>
                                            <div class="col-sm-5">
                                            {{ $supplier->fax_number }}
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
