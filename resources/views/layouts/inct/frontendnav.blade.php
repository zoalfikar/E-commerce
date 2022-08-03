<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <ul class="navbar-nav" >
        <li class="nav-item ">
          <a  class="nav-link  " href="{{url('/')}}">Home </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link"  href="{{url('/orders')}}">my orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/showCategories')}}">categories</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{url('/cart')}}">
                <span class="badge badge-pill bg-primary cat-items-count"></span>cart
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{url('/wishlist')}}">
                <span class="badge badge-pill bg-success wishlist-items-count"></span>wishlist
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{url('/stores')}}">
                <span class="badge badge-pill bg-success wishlist-items-count"></span>stores
            </a>
        </li>
    @auth
        <li class="nav-item">
            @include('layouts/inct/notifications')
        </li>
    @endauth

    </ul>
    <div class="search-bar">
        <form action="{{url('/get-product')}}" method="POST">
            @csrf
            <div class="input-group">
                <input  type="search" name="search" id="search_product" class="form-control" placeholder="search" aria-label="Username" aria-describedby="basic-addon1">
                <button type="submit" class="input-group-text" ><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <ul class="navbar-nav ms-auto" >
        <div class="collapse navbar-collapse" id="navbarNav">
            <li class="nav-item">
                <div class="dropdown" style="padding-left:55px;">
                    <select class="btn btn-secondary dropdown-toggle" style="background-color:rgb(129, 131, 255)" class="form-select form-select-sm float-end " aria-label="Default select example" id="lang" >
                        @php $lang=selectLan(); @endphp
                        @isset($record)
                            @foreach ($lang as $item)
                                <option {{$item->abbe==lang()?'selected':''}} value="{{$item->abbe}}"> {{$item->name}}</option>
                            @endforeach
                            @else
                            <option {{"en"==lang()?'selected':''}} value="en"> en</option>

                        @endisset

                      </select>
                </div>
            </li>
            @guest

            <li class="nav-item">
                <a class="nav-link " href="{{url('login')}}">login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('register')}}">register</a>
            </li>

            @else

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @if (storeOwner())
            <li class="nav-item">
                <a class="nav-link " href="{{url('store-panel')}}">my store</a>
            </li>
            @endif
            @if (isAdmin())
            <a class="nav-link " href="{{url('/dashboard')}}">  Dashboard</a>

            @else
            <li class="nav-item">
                <a class="nav-link " href="#">{{Auth::user()->name}}</a>
            </li>
            @endif

            @endguest
        </div>
    </ul>
</nav>
