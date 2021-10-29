@extends('admin.layout.app')
@section('css')
<link href="{{ asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/assets/plugins/datatable/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
          
             @if($view=='orders')
            @include('supplier.'.$view)
            @else
            @include('catalog.'.$view.'.index')
            @endif
            
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>
@endsection
@section('script')
<!-- Data tables -->
<script src="{{ asset('admin/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable.js') }}"></script>
@endsection
