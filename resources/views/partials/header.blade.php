<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                LOGO
            </a>
            <p class="main-url hide">{{ url('/') }}</p>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else

                    @if(Auth::user()->role == "0") 
                        <li {{ Request::is('users') ? ' class=active' : null }}><a href="{{ url('/users') }}">Users</a></li>
                        <li {{ Request::is('create-user') ? ' class=active' : null }}><a href="{{ url('/create-user') }}">Create User</a></li>
                        <li {{ Request::is('urls') ? ' class=active' : null }}><a href="{{ url('/urls') }}">Urls</a></li>
                        <li {{ Request::is('generate-password') ? ' class=active' : null }}><a href="{{ url('/generate-password') }}">Generate Password</a></li>
                        <li {{ Request::is('notification') ? ' class=active' : null }}><a href="{{ url('/notification') }}"><i class="fas fa-globe-americas get-notification"><h4></h4></i></a></li>
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            @if(Auth::user()->role == "0") 
                                <li {{ Request::is('view-admin') ? ' class=active' : null }}><a href="{{ url('/view-admin') }}">Admin</a></li>
                            @endif

                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>