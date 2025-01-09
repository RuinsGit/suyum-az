@extends('back.layouts.master')

@section('title', 'Müştəri Redaktə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Müştəri Redaktə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pages.customer.index') }}">Müştərilər</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Şəkil</label>
                                        @if($customer->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($customer->image) }}" alt="Current Image" 
                                                     class="img-thumbnail" 
                                                     style="max-height: 150px">
                                            </div>
                                        @endif
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Maksimum 2MB, Formatlar: jpeg, jpg, png, gif, webp</small>
                                        
                                        <!-- ALT etiketleri -->
                                        <div class="mt-2">
                                            <input type="text" name="image_alt_az" value="{{ old('image_alt_az', $customer->image_alt_az) }}" 
                                                   class="form-control mb-2" placeholder="Şəkil ALT (AZ)">
                                            <input type="text" name="image_alt_en" value="{{ old('image_alt_en', $customer->image_alt_en) }}" 
                                                   class="form-control mb-2" placeholder="Image ALT (EN)">
                                            <input type="text" name="image_alt_ru" value="{{ old('image_alt_ru', $customer->image_alt_ru) }}" 
                                                   class="form-control" placeholder="Изображение ALT (RU)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="link">Link</label>
                                        <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" 
                                               value="{{ old('link', $customer->link) }}" placeholder="https://example.com">
                                        @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('pages.customer.index') }}" class="btn btn-secondary">Ləğv et</a>
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
<style>
    .form-label {
        font-weight: 500;
    }
    .img-thumbnail {
        max-width: 200px;
    }
</style>
@endpush 