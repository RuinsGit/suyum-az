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
                        <i class="ri-contacts-line"></i>
                        <span>Əlaqə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pages.contact.index') }}">
                                <i class="ri-contacts-line"></i>
                                <span>Əlaqə Məlumatları</span>
                            </a>
                        </li>
                        <li>
    <a href="{{ route('pages.contact-form.index') }}" class="waves-effect">
                                <i class="ri-message-2-line"></i>
                                <span>Müraciətlər</span>
                                @php
                                    $unreadCount = \App\Models\ContactForm::where('status', 0)->count();
                                @endphp
                                @if($unreadCount > 0)
            <span class="badge rounded-pill bg-danger float-end">{{ $unreadCount }}</span>
        @endif
                            </a>
                        </li>
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
                    <a href="{{ route('pages.about.index') }}" class="waves-effect">
                        <i class="ri-information-line"></i>
                        <span>Haqqımızda</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.product.index') }}" class="waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span>Məhsullar</span>
                    </a>
                </li>

                <li>
        <a href="{{ route('pages.certificate.index') }}" class="waves-effect">
        <i class="ri-award-line"></i>
        <span>Sertifikatlar</span>
    </a>
        </li>

                <li>
                    <a href="{{ route('pages.service.index') }}" class="waves-effect">
                        <i class="ri-service-line"></i>
                        <span>Xidmətlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.customer.index') }}" class="waves-effect">
                        <i class="ri-user-line"></i>
                        <span>Müştərilər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.project.index') }}" class="waves-effect">
                        <i class="ri-building-line"></i>
                        <span>Layihələr</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.translations.index') }}" class="waves-effect">
                        <i class="ri-translate"></i>
                        <span>Tərcümələr</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.social.index') }}" class="waves-effect">
                        <i class="ri-share-line"></i>
                        <span>Sosial Şəbəkələr</span>
                    </a>
                </li>

                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
