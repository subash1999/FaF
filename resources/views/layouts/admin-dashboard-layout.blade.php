<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h4>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#adminNavbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="adminNavbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                       href="{{ route('admin.dashboard') }}">Summary</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" id="productCategoryDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Product Categories
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="productCategoryDropdown">
                                        <li><a class="dropdown-item"
                                               href="{{ route('admin.product-categories.create') }}">Add New Product
                                                Categories</a></li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('admin.product-categories.index') }}">All Product
                                                Categories</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" id="productCategoryDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Products
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="productCategoryDropdown">
                                        <li><a class="dropdown-item" href="{{ route('admin.products.create') }}">Add New
                                                Product</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">All
                                                Products</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" id="productCategoryDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Customers
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="productCategoryDropdown">
                                        <li><a class="dropdown-item" href="{{ route('admin.customers.index') }}">All
                                                Customers</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" href="#" id="productCategoryDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admins
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="productCategoryDropdown">
                                        <li><a class="dropdown-item" href="{{ route('admin.admins.create') }}">Add New
                                                Admin</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.admins.index') }}">All
                                                Admins</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('admin.orders.index') }}">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('admin.bills.index') }}">Bills</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="ml-5 mr-5">
                    @yield('admin-content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
