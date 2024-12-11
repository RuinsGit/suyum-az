@extends('back.layouts.master')

@section('title', 'Alt Kateqoriya Əlavə Et')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Alt Kateqoriya Əlavə Et</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('pages.subcategory.index') }}">Alt Kateqoriyalar</a></li>
                            <li class="breadcrumb-item active">Əlavə Et</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pages.subcategory.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label" for="category_id">Kateqoriya</label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Kateqoriya seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_az }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name_az">Ad (AZ)</label>
                                <input type="text" class="form-control @error('name_az') is-invalid @enderror" 
                                       id="name_az" name="name_az" value="{{ old('name_az') }}">
                                @error('name_az')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name_en">Ad (EN)</label>
                                <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                       id="name_en" name="name_en" value="{{ old('name_en') }}">
                                @error('name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name_ru">Ad (RU)</label>
                                <input type="text" class="form-control @error('name_ru') is-invalid @enderror" 
                                       id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                                @error('name_ru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                                <a href="{{ route('pages.subcategory.index') }}" class="btn btn-secondary">Ləğv Et</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 