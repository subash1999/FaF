<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('favicon/favicon.ico') }}" alt="FaF" height="40px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active  active" aria-current="page" href="{{ route('products.index') }}">All
                        Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active  dropdown-toggle" href="#" id="productCategoryDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Product Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productCategoryDropdown">
                        @foreach (\App\Models\ProductCategory::all()->take(3) as $pc)
                            <li><a class="dropdown-item"
                                   href="{{ route('products.index',['product_category'=>$pc->id]) }}">{{ $pc->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">All Categories</a></li>
                    </ul>
                </li>

            </ul>
            <form action="{{ route('products.index') }}" class="d-flex mx-auto">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                       name="search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            @auth
                @if(Auth::user()->is_customer)
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('customer.carts.index') }}">Cart</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('customer.wishlist.index') }}">Wishlist</a>
                        </li>
                    </ul>
                @endif
            @endauth
            @auth
                <ul class="navbar-nav mx-auto">
                    @if(Auth::user()->is_admin)
                        <li class="nav-item mx-auto">
                            <a class="nav-link active  font-weight-bolder active bg-dark disabled" aria-current="page"
                               href="/">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link active  dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}" disabled>Profile</a></li>
                            @if(Auth::user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Customer Dashboard</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="#" class="text-center dropdown-item text-danger"
                                   onclick="document.getElementById('nav_logout').submit();">Logout</a>
                                <form action="{{ route('logout') }}" method="POST" id="nav_logout">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
            @guest
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active  active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active  active" aria-current="page"
                           href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endguest

        </div>
    </div>
</nav>
