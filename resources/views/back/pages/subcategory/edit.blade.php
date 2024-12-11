@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Alt Kateqoriya Düzəliş</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('pages.subcategory.index') }}">Alt Kateqoriyalar</a></li>
                            <li class="breadcrumb-item active">Düzəliş</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pages.subcategory.update', $subCategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Əsas Kateqoriya</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Kateqoriya seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_az }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ad (AZ)</label>
                                <input type="text" name="name_az" class="form-control @error('name_az') is-invalid @enderror" value="{{ $subCategory->name_az }}">
                                @error('name_az')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ad (EN)</label>
                                <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ $subCategory->name_en }}">
                                @error('name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ad (RU)</label>
                                <input type="text" name="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ $subCategory->name_ru }}">
                                @error('name_ru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="status" name="status" {{ $subCategory->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Aktiv</label>
                            </div> -->

                            <button type="submit" class="btn btn-primary">Yenilə</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 