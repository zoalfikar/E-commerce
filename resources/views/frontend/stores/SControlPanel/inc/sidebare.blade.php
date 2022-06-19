<div class="sidebar-wrapper">
    <div class="logo">
        <a href="{{url('/')}}" class="simple-text">
            E-Commerce
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-white {{Request::is('category')?'active':''}}  " href={{ url('/store-categores') }}>
              <span class="nav-link-text ms-1">categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{Request::is('add-category')?'active':''}} " href={{ url('/store-add-category') }}>
            <p class="nav-link-text ms-1"> add catecory</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{Request::is('products')?'active':''}}  " href={{ url('/store-products') }}>
                <span class="nav-link-text ms-1">products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{Request::is('add-product')?'active':''}} " href={{ url('/store-add-product') }}>
                <span class="nav-link-text ms-1"> add product</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="dashboard.html">
                <i class="nc-icon nc-icon nc-paper-2"></i>
                <p>First example</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="./user.html">
                <i class="nc-icon nc-bell-55"></i>
                <p>Second example</p>
            </a>
        </li>

        <li class="nav-item active active-pro">
            <a class="nav-link active" href="javascript:;">
                <i class="nc-icon nc-alien-33"></i>
                <p>Upgrade plan</p>
            </a>
        </li>
    </ul>
</div>

