<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarNav">
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
       </ul>
       <ul class="navbar-nav ms-auto" >

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
        <li class="nav-item">
            <a class="nav-link " href="#">{{Auth::user()->name}}</a>
        </li>

        @endguest

      </ul>
    </div>
  </nav>
