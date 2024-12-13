@extends('back.layouts.master')

@section('title', 'Yeni Sertifikat')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Sertifikat</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pages.certificate.index') }}">Sertifikatlar</a></li>
                                <li class="breadcrumb-item active">Yeni</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.certificate.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content p-3 text-muted">
                                    <!-- Az tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Mətn (AZ)</label>
                                            <textarea name="text_az" class="form-control summernote">{{ old('text_az') }}</textarea>
                                            @error('text_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- En tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Text (EN)</label>
                                            <textarea name="text_en" class="form-control summernote">{{ old('text_en') }}</textarea>
                                            @error('text_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Ru tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Текст (RU)</label>
                                            <textarea name="text_ru" class="form-control summernote">{{ old('text_ru') }}</textarea>
                                            @error('text_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Şəkil</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('pages.certificate.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $(".summernote").summernote();
        $('.dropdown-toggle').dropdown();
    });
</script>
@endpush 