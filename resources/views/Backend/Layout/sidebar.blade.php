<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar ">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center ">
        <a class="navbar-brand brand-logo" href="index-2.html"><img src="{{ asset('images/navlogo.png') }}"
                alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="{{ asset('images/logo-mini.png') }}"
                alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch ">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
        </ul>
        {{-- <img src="{{asset('images/profile.gif')}}" alt="profile"/> --}}
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="/images/logo-mini.png" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('adminLogout') }}" class="dropdown-item">
                        <i class="fas fa-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="fas fa-bars"></span>
        </button>
    </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper ">

    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas " id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="profile-image">
                        <img src="{{ asset('images/profile.gif') }}" alt="image" />
                    </div>
                    <div class="profile-name">
                        <p class="name">
                            Welcome {{ session()->get('user') }}
                        </p>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.visitor') }}">
                    <i class="fa fa-puzzle-piece menu-icon"></i>
                    <span class="menu-title">Visitor</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.services') }}">
                    <i class="fa fa-briefcase menu-icon"></i>
                    <span class="menu-title">Services</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.course') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Course</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.project') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Project</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.contact') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Contact</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.review') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Review</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.blog') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Blog</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.gallery') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Gallery</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminLogout') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </li>

            {{-- <li class="nav-item d-none d-lg-block">
                <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false"
                    aria-controls="sidebar-layouts">
                    <i class="fas fa-columns menu-icon"></i>
                    <span class="menu-title">Sidebar Layouts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="sidebar-layouts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/layout/compact-menu.html">Compact menu</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-collapsed.html">Icon
                                menu</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden.html">Sidebar
                                Hidden</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/layout/sidebar-hidden-overlay.html">Sidebar Overlay</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-fixed.html">Sidebar
                                Fixed</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="far fa-compass menu-icon"></i>
                    <span class="menu-title">Basic UI Elements</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/accordions.html">Accordions</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">Badges</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">Modals</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">Progress
                                bar</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/pagination.html">Pagination</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/typography.html">Typography</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltips</a>
                        </li>
                    </ul>
                </div>
            </li> --}}


        </ul>
    </nav>
