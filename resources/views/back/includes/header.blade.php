<style>
    #page-topbar {
        background: linear-gradient(135deg, #1a1e21 0%, #2c3034 100%);
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    .navbar-header {
        padding: 0 24px;
        height: 70px;
    }

    /* Logo stilleri */
    .navbar-brand-box {
        padding: 0 1.5rem;
        transition: all 0.3s ease;
    }

    .logo {
        transition: all 0.3s ease;
    }

    .logo img {
        transition: transform 0.3s ease;
    }

    .logo:hover img {
        transform: scale(1.05);
    }

    /* Menü butonu */
    #vertical-menu-btn {
        color: #fff;
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }

    #vertical-menu-btn:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px);
    }

    #vertical-menu-btn i {
        font-size: 22px;
    }

    /* Kullanıcı dropdown */
    .user-dropdown {
        margin-left: 10px;
    }

    #page-header-user-dropdown {
        padding: 6px 12px;
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    #page-header-user-dropdown:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px);
    }

    #page-header-user-dropdown img {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        margin-right: 8px;
        border: 2px solid rgba(255,255,255,0.2);
    }

    #page-header-user-dropdown span {
        color: #fff;
        font-weight: 500;
        font-size: 14px;
    }

    #page-header-user-dropdown i {
        color: #fff;
        font-size: 16px;
    }

    /* Dropdown menü */
    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        padding: 8px;
        min-width: 200px;
        margin-top: 10px;
    }

    .dropdown-menu .dropdown-item {
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background: rgba(0,0,0,0.05);
        transform: translateX(5px);
    }

    .dropdown-menu .dropdown-item i {
        margin-right: 10px;
        font-size: 16px;
    }

    /* Çıkış butonu özel stil */
    .dropdown-item.text-danger {
        color: #e74c3c !important;
    }

    .dropdown-item.text-danger:hover {
        background: rgba(231, 76, 60, 0.1);
    }

    .dropdown-item.text-danger i {
        color: #e74c3c;
    }

    /* Responsive düzenlemeler */
    @media (max-width: 768px) {
        .navbar-header {
            padding: 0 15px;
        }

        .navbar-brand-box {
            padding: 0 1rem;
        }

        #page-header-user-dropdown span {
            display: none;
        }
    }
</style>

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex align-items-center">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/suyum_logo.png') }}" alt="logo-sm" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/suyum_logo.png') }}" alt="logo-dark" height="50">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/suyum_logo.png') }}" alt="logo-sm-light" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/suyum_logo.png') }}" alt="logo-light" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('back/assets/images/suyum_logo.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ auth()->guard('admin')->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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