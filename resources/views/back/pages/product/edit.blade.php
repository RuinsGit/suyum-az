@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Başlık -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Məhsul Redaktə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('pages.product.index') }}">Məhsullar</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Kategoriya və Alt Kategoriya -->
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="category_id">Kateqoriya</label>
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Kateqoriya seçin</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name_az }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="sub_category_id">Alt Kateqoriya</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror">
                                            <option value="">Alt kateqoriya seçin</option>
                                            @if($product->sub_category_id)
                                                <option value="{{ $product->sub_category_id }}" selected>
                                                    {{ $product->subCategory->name_az }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('sub_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Mövcud şəkillər -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-images me-2 text-primary"></i>
                                                    Mövcud şəkillər
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if($product->main_image)
                                                        <div class="col-md-3 mb-3 ruins">
                                                            <div class="image-card">
                                                                <div class="image-card-header">
                                                                    <span class="badge bg-primary">Əsas şəkil</span>
                                                                    <!-- <button type="button" class="delete-image-btn" data-image="main_image"> -->
                                                                        <i class="fas fa-times rui"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset($product->main_image) }}" alt="Əsas şəkil" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($product->courier_image)
                                                        <div class="col-md-3 mb-3 ruins">
                                                            <div class="image-card">
                                                                <div class="image-card-header">
                                                                    <span class="badge bg-info">Kuryer şəkli</span>
                                                                    <!-- <button type="button" class="delete-image-btn" data-image="courier_image"> -->
                                                                        <i class="fas fa-times rui"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset($product->courier_image) }}" alt="Kuryer şəkli" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($product->installation_image)
                                                        <div class="col-md-3 mb-3 ruins">
                                                            <div class="image-card">
                                                                <div class="image-card-header">
                                                                    <span class="badge bg-success">Quraşdırma şəkli</span>
                                                                    <!-- <button type="button" class="delete-image-btn" data-image="installation_image"> -->
                                                                        <i class="fas fa-times rui"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset($product->installation_image) }}" alt="Quraşdırma şəkli" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($product->payment_image_1)
                                                        <div class="col-md-3 mb-3 ruins">
                                                            <div class="image-card">
                                                                <div class="image-card-header">
                                                                    <span class="badge bg-warning">Ödəniş şəkli 1</span>
                                                                    <!-- <button type="button" class="delete-image-btn" data-image="payment_image_1"> -->
                                                                        <i class="fas fa-times rui"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset($product->payment_image_1) }}" alt="Ödəniş şəkli 1" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($product->payment_image_2)
                                                        <div class="col-md-3 mb-3 ruins">
                                                            <div class="image-card">
                                                                <div class="image-card-header">
                                                                    <span class="badge bg-warning">Ödəniş şəkli 2</span>
                                                                    <!-- <button type="button" class="delete-image-btn" data-image="payment_image_2"> -->
                                                                        <i class="fas fa-times rui"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="image-wrapper">
                                                                    <img src="{{ asset($product->payment_image_2) }}" alt="Ödəniş şəkli 2" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dil tabları -->
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span>AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span>EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span>RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab məzmunları -->
                                <div class="tab-content">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ad (AZ)</label>
                                                <input type="text" name="name_az" value="{{ old('name_az', $product->name_az) }}" class="form-control @error('name_az') is-invalid @enderror">
                                                @error('name_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kartric (AZ)</label>
                                                <input type="text" name="cartridge_az" value="{{ old('cartridge_az', $product->cartridge_az) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təzyiq aralığı (AZ)</label>
                                                <input type="text" name="pressure_range_az" value="{{ old('pressure_range_az', $product->pressure_range_az) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Temperatur aralığı (AZ)</label>
                                                <input type="text" name="temperature_range_az" value="{{ old('temperature_range_az', $product->temperature_range_az) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ölçülər (AZ)</label>
                                                <input type="text" name="dimensions_az" value="{{ old('dimensions_az', $product->dimensions_az) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Zəmanət (AZ)</label>
                                                <input type="text" name="warranty_az" value="{{ old('warranty_az', $product->warranty_az) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ölkə (AZ)</label>
                                                <input type="text" name="country_az" value="{{ old('country_az', $product->country_az) }}" class="form-control">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Təsvir (AZ)</label>
                                                <textarea 
                                                    name="description_az" 
                                                    class="form-control summernote @error('description_az') is-invalid @enderror"
                                                >{{ old('description_az', $product->description_az) }}</textarea>
                                                @error('description_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Name (EN)</label>
                                                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="form-control @error('name_en') is-invalid @enderror">
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Cartridge (EN)</label>
                                                <input type="text" name="cartridge_en" value="{{ old('cartridge_en', $product->cartridge_en) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Pressure Range (EN)</label>
                                                <input type="text" name="pressure_range_en" value="{{ old('pressure_range_en', $product->pressure_range_en) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Temperature Range (EN)</label>
                                                <input type="text" name="temperature_range_en" value="{{ old('temperature_range_en', $product->temperature_range_en) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dimensions (EN)</label>
                                                <input type="text" name="dimensions_en" value="{{ old('dimensions_en', $product->dimensions_en) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Warranty (EN)</label>
                                                <input type="text" name="warranty_en" value="{{ old('warranty_en', $product->warranty_en) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Country (EN)</label>
                                                <input type="text" name="country_en" value="{{ old('country_en', $product->country_en) }}" class="form-control">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Description (EN)</label>
                                                <textarea 
                                                    name="description_en" 
                                                    class="form-control summernote @error('description_en') is-invalid @enderror"
                                                >{{ old('description_en', $product->description_en) }}</textarea>
                                                @error('description_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Название (RU)</label>
                                                <input type="text" name="name_ru" value="{{ old('name_ru', $product->name_ru) }}" class="form-control @error('name_ru') is-invalid @enderror">
                                                @error('name_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Картридж (RU)</label>
                                                <input type="text" name="cartridge_ru" value="{{ old('cartridge_ru', $product->cartridge_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Диапазон давления (RU)</label>
                                                <input type="text" name="pressure_range_ru" value="{{ old('pressure_range_ru', $product->pressure_range_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Диапазон температур (RU)</label>
                                                <input type="text" name="temperature_range_ru" value="{{ old('temperature_range_ru', $product->temperature_range_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Размеры (RU)</label>
                                                <input type="text" name="dimensions_ru" value="{{ old('dimensions_ru', $product->dimensions_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Гарантия (RU)</label>
                                                <input type="text" name="warranty_ru" value="{{ old('warranty_ru', $product->warranty_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Страна (RU)</label>
                                                <input type="text" name="country_ru" value="{{ old('country_ru', $product->country_ru) }}" class="form-control">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Описание (RU)</label>
                                                <textarea 
                                                    name="description_ru" 
                                                    class="form-control summernote @error('description_ru') is-invalid @enderror"
                                                >{{ old('description_ru', $product->description_ru) }}</textarea>
                                                @error('description_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Qiymət və Taksit -->
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Qiymət (AZN)</label>
                                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Endirim (%)</label>
                                        <input type="number" step="0.01" name="discount" value="{{ old('discount', $product->discount) }}" class="form-control @error('discount') is-invalid @enderror">
                                        @error('discount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">İllik faiz (%)</label>
                                        <input type="number" step="0.01" name="annual_percentage" value="{{ old('annual_percentage', $product->annual_percentage) }}" class="form-control @error('annual_percentage') is-invalid @enderror">
                                        @error('annual_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kredit müddətləri</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php
                                                $installmentMonths = old('installment_months', $product->installment_months ?? []);
                                                if (!is_array($installmentMonths)) {
                                                    $installmentMonths = explode(',', $installmentMonths);
                                                }
                                            @endphp

                                            @foreach([6, 12, 18, 24] as $month)
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="installment_months[]" 
                                                       value="{{ $month }}" 
                                                       id="month{{ $month }}" 
                                                       {{ in_array($month, $installmentMonths) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="month{{ $month }}">
                                                    {{ $month }} ay
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Taksit hesablama cədvəli -->
                                <div class="row mt-3" id="installmentPreview" style="display: none;">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Kredit Hesablaması</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Müddət</th>
                                                                <th>Aylıq ödəniş</th>
                                                                <th>Ümumi məbləğ</th>
                                                                <th>Faiz məbləği</th>
                                                                <th>Əməliyyatlar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="installmentTable">
                                                            <!-- JavaScript ile doldurulacak -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Xidmətlər -->
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="has_courier" id="has_courier" 
                                                   {{ old('has_courier', $product->has_courier) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_courier">Kuryer xidməti</label>
                                        </div>
                                        <div class="mt-2" id="courier_price_div">
                                            <label class="form-label">Kuryer qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="courier_price" 
                                                   value="{{ old('courier_price', $product->courier_price) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="has_installation" id="has_installation" 
                                                   {{ old('has_installation', $product->has_installation) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_installation">Quraşdırılma xidməti</label>
                                        </div>
                                        <div class="mt-2" id="installation_price_div">
                                            <label class="form-label">Quraşdırılma qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="installation_price" 
                                                   value="{{ old('installation_price', $product->installation_price) }}" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Yeni Şəkillər -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Yeni şəkillər</h5>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Əsas şəkil</label>
                                        <input type="file" name="main_image" class="form-control @error('main_image') is-invalid @enderror">
                                        @error('main_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kuryer şəkli</label>
                                        <input type="file" name="courier_image" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Quraşdırılma şəkli</label>
                                        <input type="file" name="installation_image" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ödəniş şəkli 1</label>
                                        <input type="file" name="payment_image_1" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ödəniş şəkli 2</label>
                                        <input type="file" name="payment_image_2" class="form-control">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mt-4">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" id="status" 
                                                   {{ old('status', $product->status) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Yadda saxla
                                        </button>
                                        <a href="{{ route('pages.product.index') }}" class="btn btn-secondary ms-2">
                                            <i class="fas fa-arrow-left me-2"></i>Geri qayıt
                                        </a>
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
    .image-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .image-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .image-card-header {
        padding: 10px;
        background: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .image-wrapper {
        position: relative;
        padding-top: 75%; /* 4:3 aspect ratio */
        overflow: hidden;
        flex-grow: 1;
    }

    .image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-card-footer {
        padding: 10px;
        background: #f8f9fa;
        border-top: 1px solid rgba(0,0,0,.125);
    }

    .delete-image-btn {
        background: #dc3545;
        color: white;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0;
        font-size: 12px;
    }
    .rui{
        visibility: hidden;
    }

    .delete-image-btn:hover {
        background: #c82333;
        transform: scale(1.1);
    }

    .badge {
        padding: 6px 10px;
        font-weight: 500;
    }
    .ruins{width: 19.9%;}
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
function calculateLoan() {
    const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
    const annualRate = parseFloat(document.querySelector('input[name="annual_percentage"]').value) || 0;
    const selectedMonths = Array.from(document.querySelectorAll('input[name="installment_months[]"]:checked'))
        .map(checkbox => parseInt(checkbox.value));
    
    if (price <= 0 || selectedMonths.length === 0) {
        document.getElementById('installmentPreview').style.display = 'none';
        return;
    }

    let tableHtml = '';
    
    selectedMonths.forEach(months => {
        const monthlyRate = annualRate / 12 / 100;
        const monthlyPayment = price * monthlyRate * Math.pow(1 + monthlyRate, months) 
                             / (Math.pow(1 + monthlyRate, months) - 1);
        const totalPayment = monthlyPayment * months;
        const totalInterest = totalPayment - price;

        let remainingDebt = price;
        let monthlyDetails = '';

        for (let month = 1; month <= months; month++) {
            const monthlyInterest = remainingDebt * monthlyRate;
            const monthlyPrincipal = monthlyPayment - monthlyInterest;
            remainingDebt -= monthlyPrincipal;

            monthlyDetails += `
                <tr class="detail-row detail-${months}" style="display: none;">
                    <td>${month}</td>
                    <td>${monthlyPrincipal.toFixed(2)}</td>
                    <td>${monthlyInterest.toFixed(2)}</td>
                    <td>${monthlyPayment.toFixed(2)}</td>
                    <td>${Math.max(0, remainingDebt).toFixed(2)}</td>
                </tr>
            `;
        }

        tableHtml += `
            <tr class="main-row">
                <td>${months} ay</td>
                <td>${monthlyPayment.toFixed(2)} AZN</td>
                <td>${totalPayment.toFixed(2)} AZN</td>
                <td>${totalInterest.toFixed(2)} AZN</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" 
                            onclick="toggleDetails(${months})">
                        Detaylar
                    </button>
                </td>
            </tr>
        `;
        
        tableHtml += monthlyDetails;
    });

    document.getElementById('installmentTable').innerHTML = tableHtml;
    document.getElementById('installmentPreview').style.display = 'block';
}

function toggleDetails(months) {
    const detailRows = document.querySelectorAll(`.detail-${months}`);
    const isHidden = detailRows[0].style.display === 'none';
    
    detailRows.forEach(row => {
        row.style.display = isHidden ? 'table-row' : 'none';
    });
}

// Servis fiyatlarını göster/gizle
function togglePriceField(checkboxId, priceFieldId) {
    const checkbox = document.getElementById(checkboxId);
    const priceField = document.getElementById(priceFieldId);
    
    function updateVisibility() {
        priceField.style.display = checkbox.checked ? 'block' : 'none';
    }
    
    checkbox.addEventListener('change', updateVisibility);
    updateVisibility();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Kredi hesaplama için event listeners
    document.querySelector('input[name="price"]').addEventListener('input', calculateLoan);
    document.querySelector('input[name="annual_percentage"]').addEventListener('input', calculateLoan);
    document.querySelectorAll('input[name="installment_months[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', calculateLoan);
    });

    // Servis fiyatları için event listeners
    togglePriceField('has_courier', 'courier_price_div');
    togglePriceField('has_installation', 'installation_price_div');

    // İlk yüklemede kredi hesaplama
    calculateLoan();

    // Resim silme işlemi
    document.querySelectorAll('.delete-image-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Bu şəkli silmək istədiyinizə əminsiniz?')) return;

            const imageType = this.dataset.image;
            try {
                const response = await fetch(`/admin/product/${product.id}/delete-image/${imageType}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.closest('.col-md-3').remove();
                    toastr.success('Şəkil uğurla silindi');
                } else {
                    toastr.error('Şəkil silinərkən xəta baş verdi');
                }
            } catch (error) {
                toastr.error('Sistem xətası baş verdi');
            }
        });
    });

    // Form validasyonu
    document.querySelector('form').addEventListener('submit', function(e) {
        const price = parseFloat(document.querySelector('input[name="price"]').value);
        if (!price || price <= 0) {
            e.preventDefault();
            toastr.error('Qiymət düzgün daxil edilməyib');
            return false;
        }

        const hasCourier = document.getElementById('has_courier').checked;
        const hasInstallation = document.getElementById('has_installation').checked;

        if (hasCourier) {
            const courierPrice = parseFloat(document.querySelector('input[name="courier_price"]').value);
            if (!courierPrice || courierPrice <= 0) {
                e.preventDefault();
                toastr.error('Kuryer qiyməti düzgün daxil edilməyib');
                return false;
            }
        }

        if (hasInstallation) {
            const installationPrice = parseFloat(document.querySelector('input[name="installation_price"]').value);
            if (!installationPrice || installationPrice <= 0) {
                e.preventDefault();
                toastr.error('Quraşdırılma qiyməti düzgün daxil edilməyib');
                return false;
            }
        }
    });
});

$(document).ready(function() {
    // Kategori değiştiğinde alt kategorileri getir
    $('#category_id').on('change', function() {
        var categoryId = $(this).val();
        var subCategorySelect = $('#sub_category_id');
        
        // Kategori seçili değilse alt kategorileri temizle
        if (!categoryId) {
            subCategorySelect.html('<option value="">Alt kateqoriya seçin</option>');
            return;
        }

        // AJAX isteği ile alt kategorileri getir
        $.ajax({
            url: '/admin/pages/get-subcategories/' + categoryId,
            type: 'GET',
            success: function(response) {
                console.log('Alt kategoriler:', response);
                var options = '<option value="">Alt kateqoriya seçin</option>';
                response.forEach(function(subCategory) {
                    options += `<option value="${subCategory.id}">${subCategory.name_az}</option>`;
                });
                subCategorySelect.html(options);
                
                // Eğer eski bir alt kategori seçili ise, onu seç
                @if($product->sub_category_id)
                    subCategorySelect.val('{{ $product->sub_category_id }}');
                @endif
            },
            error: function(xhr) {
                console.error('Alt kategoriler yüklenirken hata oluştu:', xhr);
                toastr.error('Alt kategoriler yüklenirken hata oluştu');
            }
        });
    });

    // Sayfa yüklendiğinde eğer kategori seçili ise alt kategorileri getir
    if ($('#category_id').val()) {
        $('#category_id').trigger('change');
    }

    $(".summernote").summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    $('.dropdown-toggle').dropdown();
});
</script>
@endpush