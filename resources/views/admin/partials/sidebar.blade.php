






<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar doc-sidebar">
    <div class="app-sidebar__user clearfix">
        <div class="dropdown user-pro-body">
            <div>
                {{--<img src="{{ asset('images/User/'. Auth::user()->image) }}" alt="user-img"
                  class="avatar avatar-lg brround">--}}
                  <img src="{{ asset('images/Product/royal_donuts.png') }}" alt="user-img"
                  class="avatar avatar-lg brround">
                <!--<a href="#"  class="profile-img">-->
                <!--    <span class="fa fa-pencil" aria-hidden="true"></span>-->
                <!--</a>-->
                
            </div>
            <div class="user-info">
                <h2>{{ Auth::user()->name }}</h2>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>



    {{-- <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-airplay"></i><span
                    class="side-menu__label">Catalog</span><i class="angle fa fa-angle-right"></i></a> --}}
    {{-- <ul class="slide-menu">--}}
    <ul class="p-5">
        <li><a class="slide-item" href="{{ route('product.index') }}">Product</a></li>
        <li><a class="slide-item" href="{{ route('category.index') }}">Category</a></li>
        <li><a class="slide-item" href="{{ route('unit.index') }}">Unit</a></li>
        <!-- <li><a class="slide-item" href="{{ route('inventory.index') }}">Inventory</a></li> -->
        <li><a class="slide-item" href="{{ route('customer.index') }}">Customer</a></li>
        <li><a class="slide-item" href="{{ route('broadcast.index') }}">Broadcast Email</a></li>
        <li><a class="slide-item" href="{{ route('broadcast_group.index') }}">Email Group</a></li>
        <li><a class="slide-item" href="{{ route('manufacturing_partner.index') }}">Manufacturer</a></li>
        <li><a class="slide-item" href="{{ route('supplier.index') }}">Supplier</a></li>




    </ul>
    {{-- </li>
    </ul> --}}


    
</aside>
<!-- /Sidebar menu-->
