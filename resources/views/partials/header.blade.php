<div class="header_section">
    <div class="header_main">
        <div class="mobile_menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="logo_mobile">
                    <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}"></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="logo">
                {{-- <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}"></a> --}}
            </div>
            <div class="menu_main">
                <ul>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.blogs.index') }}">Home</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit();">

                            Logout
                            </a>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
