<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <ul class="navbar-nav" >
        <li class="nav-item ">
          <a  class="nav-link  " href="{{url('/')}}">الرئيسية </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link"  href="{{url('/orders')}}">طلباتي</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/showCategories')}}">الفئات</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{url('/cart')}}">
                <span class="badge badge-pill bg-primary cat-items-count"></span>البطاقة
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{url('/wishlist')}}">
                <span class="badge badge-pill bg-success wishlist-items-count"></span>الحقيبة
            </a>
        </li>
    </ul>
    <div class="search-bar">
        <form action="{{url('/get-product')}}" method="POST">
            @csrf
            <div class="input-group">
                <input  type="search" name="search" id="search_product" class="form-control" placeholder="بحث" aria-label="Username" aria-describedby="basic-addon1">
                <button type="submit" class="input-group-text" ><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="dropdown" style="padding-right:55px;">
        <select style="background-color:white" class="form-select form-select-sm float-end " aria-label="Default select example" id="lang" >
            @php $lang=selectLan(); @endphp
            @foreach ($lang as $item)
                <option {{$item->abbe==lang()?'selected':''}} value="{{$item->abbe}}"> {{$item->name}}</option>
            @endforeach
          </select>
    </div>
    <ul class="navbar-nav ms-auto" >
        <div class="collapse navbar-collapse" id="navbarNav">
        @guest

            <li class="nav-item">
                <a class="nav-link " href="{{url('login')}}">تسجيل دخول</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('register')}}">اضافة حساب</a>
            </li>

        @else

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('تسجيل خروج') }}
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

