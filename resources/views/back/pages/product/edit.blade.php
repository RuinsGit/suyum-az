@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Məhsul Redaktə</h4>
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

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Kateqoriya</label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
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
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <!-- EN dilindəki sahələr (AZ ilə eyni struktur) -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Name (EN)</label>
                                                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="form-control @error('name_en') is-invalid @enderror">
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Diğer EN alanları... -->
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <!-- RU dilindəki sahələr (AZ ilə eyni struktur) -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Название (RU)</label>
                                                <input type="text" name="name_ru" value="{{ old('name_ru', $product->name_ru) }}" class="form-control @error('name_ru') is-invalid @enderror">
                                                @error('name_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Diğer RU alanları... -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Qiymət və Xidmətlər -->
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Qiymət (AZN)</label>
                                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Aylıq faiz (%)</label>
                                        <input type="number" step="0.01" name="monthly_percentage" value="{{ old('monthly_percentage', $product->monthly_percentage) }}" class="form-control @error('monthly_percentage') is-invalid @enderror">
                                        @error('monthly_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Xidmətlər -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="has_courier" id="has_courier" {{ old('has_courier', $product->has_courier) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_courier">Kuryer xidməti</label>
                                        </div>
                                        <div class="mt-2" id="courier_price_div">
                                            <label class="form-label">Kuryer qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="courier_price" value="{{ old('courier_price', $product->courier_price) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="has_installation" id="has_installation" {{ old('has_installation', $product->has_installation) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_installation">Quraşdırılma xidməti</label>
                                        </div>
                                        <div class="mt-2" id="installation_price_div">
                                            <label class="form-label">Quraşdırılma qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="installation_price" value="{{ old('installation_price', $product->installation_price) }}" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Şəkillər -->
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Əsas şəkil</label>
                                        @if($product->main_image)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->main_image) }}" alt="Main Image" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="main_image" class="form-control @error('main_image') is-invalid @enderror">
                                        @error('main_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kuryer şəkli</label>
                                        @if($product->courier_image)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->courier_image) }}" alt="Courier Image" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="courier_image" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Quraşdırılma şəkli</label>
                                        @if($product->installation_image)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->installation_image) }}" alt="Installation Image" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="installation_image" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ödəniş şəkli 1</label>
                                        @if($product->payment_image_1)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->payment_image_1) }}" alt="Payment Image 1" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="payment_image_1" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ödəniş şəkli 2</label>
                                        @if($product->payment_image_2)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->payment_image_2) }}" alt="Payment Image 2" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="payment_image_2" class="form-control">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ old('status', $product->status) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
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

@push('js')
<script>
    // Kuryer və quraşdırılma qiymət sahələrinin görünürlüyünü idarə et
    document.getElementById('has_courier').addEventListener('change', function() {
        document.getElementById('courier_price_div').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('has_installation').addEventListener('change', function() {
        document.getElementById('installation_price_div').style.display = this.checked ? 'block' : 'none';
    });

    // Səhifə yüklənəndə də yoxla
    window.addEventListener('load', function() {
        document.getElementById('courier_price_div').style.display = 
            document.getElementById('has_courier').checked ? 'block' : 'none';
        document.getElementById('installation_price_div').style.display = 
            document.getElementById('has_installation').checked ? 'block' : 'none';
    });
</script>
@endpush