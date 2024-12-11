<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" width="80" alt="">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-application-cog"></i>
                        <span>Ana Səhifə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pages.header.index') }}">
                                <i class="mdi mdi-format-header-1"></i>
                                <span>Başlıqlar</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-application-cog"></i>
                        <span>Tənzimləmələr</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Tərcümələr</a></li>
                        <li><a href="#">Ümumi tənzimləmələr</a></li>
                        <li><a href="#">Haqqımızda</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-list-check"></i>
                        <span>Kateqoriyalar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pages.category.index') }}">
                                <i class="ri-folder-line"></i>
                                <span>Əsas Kateqoriyalar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.subcategory.index') }}">
                                <i class="ri-folder-add-line"></i>
                                <span>Alt Kateqoriyalar</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('pages.product.index') }}" class="waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span>Məhsullar</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
