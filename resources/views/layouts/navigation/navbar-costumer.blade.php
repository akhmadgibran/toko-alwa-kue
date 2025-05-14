<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-5">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('logo/logo.png') }}" alt="Bootstrap" width="50" height="50">
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0"> <!-- mx-auto untuk center -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('product.category') }}">Product</a>
                </li>

            </ul>
                        <!-- Login & Register Buttons (Mobile Only) -->
                        <div class="d-lg-none d-flex flex-column mt-3">
                            {{-- <a href="{{ route('login') }}" class="btn btn-primary mb-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success">Register</a> --}}
                            <a class="btn btn-success mb-2" href="{{ route('costumer.cart.index') }}">Cart</a>
                            <a class="btn btn-primary mb-2" href="{{ route('profile.edit') }}">Profile</a>
                            <a class="btn btn-primary mb-2" href="{{ route('costumer.order.index') }}">Order</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="width: 100%" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
        </div>

        {{-- Right Side Of Navbar --}}
        {{-- button to login route --}}
        <!-- Right Side Of Navbar (Hidden on Mobile) -->
        <div class="d-none d-lg-flex">
            {{-- <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Register</a> --}}
            <a href="{{ route('costumer.cart.index') }}">
                <img style="width: 75%" src="{{ asset('icons/mage_basket-fill.png') }}" alt="cart">
            </a>
            <a href="{{ route('costumer.order.index') }}">
                <img style="width: 75%" src="{{ asset('icons/lsicon_order-filled.png') }}" alt="">
            </a>
            <a href="{{ route('profile.edit') }}">
                <img style="width: 75%" src="{{ asset('icons/iconamoon_profile-circle-fill.png') }}" alt="profile"></a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
       
    </div>
</nav>