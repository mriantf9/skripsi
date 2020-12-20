<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    {{-- <form class="form-inline mr-auto searchform text-muted">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
    </form> --}}
    <ul class="nav">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
    
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </ul>
</nav>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{url ('/dashboard')}}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="ml-3 item-text">MRTG Report</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{url('report')}}"><span class="ml-1 item-text">Schedule Report</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{url('realtime')}}"><span class="ml-1 item-text">Realtime Report</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{url ('/customer')}}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Customers</span>
                    <!-- <span class="badge badge-pill badge-primary">New</span> -->
                </a>
            </li>
            {{-- <li class="nav-item w-100">
                <a class="nav-link" href="{{url ('counter')}}">
                    <i class="fe fe-clock fe-16"></i>
                    <span class="ml-3 item-text">Counter</span>
                    <!-- <span class="badge badge-pill badge-primary">New</span> -->
                </a>
            </li> --}}
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Apps</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fe fe-user-plus fe-16"></i>
                        <span class="ml-3 item-text">Register Account</span>
                    </a>
                </li>
                {{-- <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Documentation</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link" href="../docs/index.html">
                            <i class="fe fe-help-circle fe-16"></i>
                            <span class="ml-3 item-text">Getting Start</span>
                        </a>
                    </li>
                </ul> --}}
            </ul>
            <!-- <div class="btn-box w-100 mt-4 mb-1">
                    <button type="button" class="btn mb-2 btn-primary btn-lg btn-block">
                        <i class="fe fe-shopping-cart fe-12 mr-2"></i><span class="small">Buy now</span>
                    </button>
                </div> -->
    </nav>
</aside>