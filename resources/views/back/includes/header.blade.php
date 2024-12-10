<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" alt="logo-sm" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" alt="logo-dark" height="50">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" alt="logo-sm-light"
                            height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" alt="logo-light" height="50">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img width="80" src="{{ asset('back/assets/images/logo-eneraz.webp') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ auth()->guard('admin')->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıxış
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
