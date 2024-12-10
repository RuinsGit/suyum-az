@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Başlıqlar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('pages.header.index') }}">Başlıqlar</a></li>
                                <li class="breadcrumb-item active">Redaktə et</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Başlıq redaktə et</h4>
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">RU</span>
                                    </a>
                                </li>
                            </ul>

                            <form class="needs-validation" method="POST" action="{{ route('pages.header.update', $header->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="tab-content p-3 text-muted">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_az">Ana Səhifə (AZ)</label>
                                                    <input type="text" name="home_az" value="{{ $header->home_az }}" class="form-control">
                                                    @error('home_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="about_az">Haqqımızda (AZ)</label>
                                                    <input type="text" name="about_az" value="{{ $header->about_az }}" class="form-control">
                                                    @error('about_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="products_az">Məhsullar (AZ)</label>
                                                    <input type="text" name="products_az" value="{{ $header->products_az }}" class="form-control">
                                                    @error('products_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="services_az">Xidmətlər (AZ)</label>
                                                    <input type="text" name="services_az" value="{{ $header->services_az }}" class="form-control">
                                                    @error('services_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="projects_az">Layihələr (AZ)</label>
                                                    <input type="text" name="projects_az" value="{{ $header->projects_az }}" class="form-control">
                                                    @error('projects_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="certificates_az">Sertifikatlar (AZ)</label>
                                                    <input type="text" name="certificates_az" value="{{ $header->certificates_az }}" class="form-control">
                                                    @error('certificates_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customers_az">Müştərilər (AZ)</label>
                                                    <input type="text" name="customers_az" value="{{ $header->customers_az }}" class="form-control">
                                                    @error('customers_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact_az">Əlaqə (AZ)</label>
                                                    <input type="text" name="contact_az" value="{{ $header->contact_az }}" class="form-control">
                                                    @error('contact_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_en">Home (EN)</label>
                                                    <input type="text" name="home_en" value="{{ $header->home_en }}" class="form-control">
                                                    @error('home_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="about_en">About (EN)</label>
                                                    <input type="text" name="about_en" value="{{ $header->about_en }}" class="form-control">
                                                    @error('about_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="products_en">Products (EN)</label>
                                                    <input type="text" name="products_en" value="{{ $header->products_en }}" class="form-control">
                                                    @error('products_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="services_en">Services (EN)</label>
                                                    <input type="text" name="services_en" value="{{ $header->services_en }}" class="form-control">
                                                    @error('services_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="projects_en">Projects (EN)</label>
                                                    <input type="text" name="projects_en" value="{{ $header->projects_en }}" class="form-control">
                                                    @error('projects_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="certificates_en">Certificates (EN)</label>
                                                    <input type="text" name="certificates_en" value="{{ $header->certificates_en }}" class="form-control">
                                                    @error('certificates_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customers_en">Customers (EN)</label>
                                                    <input type="text" name="customers_en" value="{{ $header->customers_en }}" class="form-control">
                                                    @error('customers_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact_en">Contact (EN)</label>
                                                    <input type="text" name="contact_en" value="{{ $header->contact_en }}" class="form-control">
                                                    @error('contact_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_ru">Главная (RU)</label>
                                                    <input type="text" name="home_ru" value="{{ $header->home_ru }}" class="form-control">
                                                    @error('home_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="about_ru">О нас (RU)</label>
                                                    <input type="text" name="about_ru" value="{{ $header->about_ru }}" class="form-control">
                                                    @error('about_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="products_ru">Продукты (RU)</label>
                                                    <input type="text" name="products_ru" value="{{ $header->products_ru }}" class="form-control">
                                                    @error('products_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="services_ru">Услуги (RU)</label>
                                                    <input type="text" name="services_ru" value="{{ $header->services_ru }}" class="form-control">
                                                    @error('services_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="projects_ru">Проекты (RU)</label>
                                                    <input type="text" name="projects_ru" value="{{ $header->projects_ru }}" class="form-control">
                                                    @error('projects_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="certificates_ru">Сертификаты (RU)</label>
                                                    <input type="text" name="certificates_ru" value="{{ $header->certificates_ru }}" class="form-control">
                                                    @error('certificates_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customers_ru">Клиенты (RU)</label>
                                                    <input type="text" name="customers_ru" value="{{ $header->customers_ru }}" class="form-control">
                                                    @error('customers_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact_ru">Контакты (RU)</label>
                                                    <input type="text" name="contact_ru" value="{{ $header->contact_ru }}" class="form-control">
                                                    @error('contact_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Təsdiqlə</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection 