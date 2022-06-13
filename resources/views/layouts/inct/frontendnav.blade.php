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
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu notifications" aria-labelledby="dropdownMenuButton1">
                    @forelse (Auth::user()->notifications as $notification)
                        @switch($notification->type)
                            @case("App\Notifications\StoreCreated")
                                <li><a class="dropdown-item float-start" href="{{url('/storeDetails/'.$notification->data['store_slug'])}}">{{$notification->data['owner_name']}} has created new store </a>
                                    @if (! isActiveStore($notification->data['store_slug'])==1|| !isActiveStore($notification->data['store_slug'])==2)
                                        <button class="btn btn-success float-end activeStore" value="{{$notification->data['store_slug']}}">active</button><button class="btn btn-primary float-end deletStore" value="{{$notification->data['store_slug']}}">delet</button></li>
                                    @endif
                                @break
                            @case(2)
                                @break
                            @default
                            <li><a class="dropdown-item" href="#">another notifications</a></li>
                        @endswitch
                    @empty
                        <li><a class="dropdown-item" href="#">no notifications</a></li>
                    @endforelse
            </div>
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
                        @foreach ($lang as $item)
                            <option {{$item->abbe==lang()?'selected':''}} value="{{$item->abbe}}"> {{$item->name}}</option>
                        @endforeach
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

        </ul>
    </div>
</nav>
