@extends('back.layouts.master')

@section('title', 'Əlaqə Məlumatları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Əlaqə Məlumatları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Əlaqə Məlumatları</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.contact.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Nav tabs -->
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

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <!-- Az tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq 1 (AZ)</label>
                                            <input type="text" name="title1_az" class="form-control" value="{{ old('title1_az', $contact?->title1_az) }}">
                                            @error('title1_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq 2 (AZ)</label>
                                            <input type="text" name="title2_az" class="form-control" value="{{ old('title2_az', $contact?->title2_az) }}">
                                            @error('title2_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mətn (AZ)</label>
                                            <textarea name="description_az" class="form-control summernote">{{ old('description_az', $contact?->description_az) }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- En tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title 1 (EN)</label>
                                            <input type="text" name="title1_en" class="form-control" value="{{ old('title1_en', $contact?->title1_en) }}">
                                            @error('title1_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title 2 (EN)</label>
                                            <input type="text" name="title2_en" class="form-control" value="{{ old('title2_en', $contact?->title2_en) }}">
                                            @error('title2_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (EN)</label>
                                            <textarea name="description_en" class="form-control summernote">{{ old('description_en', $contact?->description_en) }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Ru tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок 1 (RU)</label>
                                            <input type="text" name="title1_ru" class="form-control" value="{{ old('title1_ru', $contact?->title1_ru) }}">
                                            @error('title1_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок 2 (RU)</label>
                                            <input type="text" name="title2_ru" class="form-control" value="{{ old('title2_ru', $contact?->title2_ru) }}">
                                            @error('title2_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Текст (RU)</label>
                                            <textarea name="description_ru" class="form-control summernote">{{ old('description_ru', $contact?->description_ru) }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Telefon Numarası -->
                                <div class="mb-3">
                                    <label class="form-label">Telefon Nomresi</label>
                                    <input type="text" name="number" class="form-control" value="{{ old('number', $contact?->number) }}">
                                    @error('number')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Resimler -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Şəkil 1</label>
                                        @if($contact?->image1)
                                            <div class="mb-2">
                                                <img src="{{ asset($contact->image1) }}" alt="Image 1" class="img-thumbnail" style="max-height: 100px">
                                            </div>
                                        @endif
                                        <input type="file" name="image1" class="form-control">
                                        @error('image1')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Şəkil 2</label>
                                        @if($contact?->image2)
                                            <div class="mb-2">
                                                <img src="{{ asset($contact->image2) }}" alt="Image 2" class="img-thumbnail" style="max-height: 100px">
                                            </div>
                                        @endif
                                        <input type="file" name="image2" class="form-control">
                                        @error('image2')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Şəkil 3</label>
                                        @if($contact?->image3)
                                            <div class="mb-2">
                                                <img src="{{ asset($contact->image3) }}" alt="Image 3" class="img-thumbnail" style="max-height: 100px">
                                            </div>
                                        @endif
                                        <input type="file" name="image3" class="form-control">
                                        @error('image3')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
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