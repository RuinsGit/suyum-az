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
                                <li class="breadcrumb-item active">Əlavə et</li>
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
                            <h4 class="card-title">Başlıq əlavə et</h4>
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
                            <form class="needs-validation" method="POST" action="{{ route('pages.header.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="az">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_az" class="form-label">Ana Səhifə (AZ)</label>
                                                    <input type="text" name="home_az" value="{{ old('home_az') }}" class="form-control">
                                                    @error('home_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="about_az" class="form-label">Haqqımızda (AZ)</label>
                                                    <input type="text" name="about_az" value="{{ old('about_az') }}" class="form-control">
                                                    @error('about_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="products_az" class="form-label">Məhsullar (AZ)</label>
                                                    <input type="text" name="products_az" value="{{ old('products_az') }}" class="form-control">
                                                    @error('products_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="services_az" class="form-label">Xidmətlər (AZ)</label>
                                                    <input type="text" name="services_az" value="{{ old('services_az') }}" class="form-control">
                                                    @error('services_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="projects_az" class="form-label">Layihələr (AZ)</label>
                                                    <input type="text" name="projects_az" value="{{ old('projects_az') }}" class="form-control">
                                                    @error('projects_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="certificates_az" class="form-label">Sertifikatlar (AZ)</label>
                                                    <input type="text" name="certificates_az" value="{{ old('certificates_az') }}" class="form-control">
                                                    @error('certificates_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="customers_az" class="form-label">Müştərilər (AZ)</label>
                                                    <input type="text" name="customers_az" value="{{ old('customers_az') }}" class="form-control">
                                                    @error('customers_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="contact_az" class="form-label">Əlaqə (AZ)</label>
                                                    <input type="text" name="contact_az" value="{{ old('contact_az') }}" class="form-control">
                                                    @error('contact_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_en" class="form-label">Ana Səhifə (EN)</label>
                                                    <input type="text" name="home_en" value="{{ old('home_en') }}" class="form-control">
                                                    @error('home_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="about_en" class="form-label">Haqqımızda (EN)</label>
                                                    <input type="text" name="about_en" value="{{ old('about_en') }}" class="form-control">
                                                    @error('about_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="products_en" class="form-label">Məhsullar (EN)</label>
                                                    <input type="text" name="products_en" value="{{ old('products_en') }}" class="form-control">
                                                    @error('products_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="services_en" class="form-label">Xidmətlər (EN)</label>
                                                    <input type="text" name="services_en" value="{{ old('services_en') }}" class="form-control">
                                                    @error('services_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="projects_en" class="form-label">Layihələr (EN)</label>
                                                    <input type="text" name="projects_en" value="{{ old('projects_en') }}" class="form-control">
                                                    @error('projects_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="certificates_en" class="form-label">Sertifikatlar (EN)</label>
                                                    <input type="text" name="certificates_en" value="{{ old('certificates_en') }}" class="form-control">
                                                    @error('certificates_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="customers_en" class="form-label">Müştərilər (EN)</label>
                                                    <input type="text" name="customers_en" value="{{ old('customers_en') }}" class="form-control">
                                                    @error('customers_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="contact_en" class="form-label">Əlaqə (EN)</label>
                                                    <input type="text" name="contact_en" value="{{ old('contact_en') }}" class="form-control">
                                                    @error('contact_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="ru">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="home_ru" class="form-label">Ana Səhifə (RU)</label>
                                                    <input type="text" name="home_ru" value="{{ old('home_ru') }}" class="form-control">
                                                    @error('home_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="about_ru" class="form-label">Haqqımızda (RU)</label>
                                                    <input type="text" name="about_ru" value="{{ old('about_ru') }}" class="form-control">
                                                    @error('about_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="products_ru" class="form-label">Məhsullar (RU)</label>
                                                    <input type="text" name="products_ru" value="{{ old('products_ru') }}" class="form-control">
                                                    @error('products_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="services_ru" class="form-label">Xidmətlər (RU)</label>
                                                    <input type="text" name="services_ru" value="{{ old('services_ru') }}" class="form-control">
                                                    @error('services_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="projects_ru" class="form-label">Layihələr (RU)</label>
                                                    <input type="text" name="projects_ru" value="{{ old('projects_ru') }}" class="form-control">
                                                    @error('projects_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="certificates_ru" class="form-label">Sertifikatlar (RU)</label>
                                                    <input type="text" name="certificates_ru" value="{{ old('certificates_ru') }}" class="form-control">
                                                    @error('certificates_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="customers_ru" class="form-label">Müştərilər (RU)</label>
                                                    <input type="text" name="customers_ru" value="{{ old('customers_ru') }}" class="form-control">
                                                    @error('customers_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="contact_ru" class="form-label">Əlaqə (RU)</label>
                                                    <input type="text" name="contact_ru" value="{{ old('contact_ru') }}" class="form-control">
                                                    @error('contact_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
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