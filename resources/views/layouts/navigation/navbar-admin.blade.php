{{-- navbar for superadmin --}}
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            {{ config('app.name', 'Kue Alwa') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('admin.product.index') }}">{{ __('Kelola Produk') }}</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('Kelola Kategori') }}</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('admin.shopstatus.index') }}">
                        {{ __('Kelola Status Toko') }}
                    </a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('admin.order.index') }}">
                        {{ __('Kelola Orderan') }}
                    </a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="{{ route('admin.productpromotion.index') }}">
                        {{ __('Kelola Product Promotion') }}
                    </a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>