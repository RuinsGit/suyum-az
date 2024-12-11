@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Məhsul</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('pages.product.index') }}">Məhsullar</a></li>
                                <li class="breadcrumb-item active">Yeni Məhsul</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kateqoriya</label>
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

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Alt Kateqoriya</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror">
                                            <option value="">Alt kateqoriya seçin</option>
                                        </select>
                                        @error('sub_category_id')
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
                                                <input type="text" name="name_az" value="{{ old('name_az') }}" class="form-control @error('name_az') is-invalid @enderror">
                                                @error('name_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kartric (AZ)</label>
                                                <input type="text" name="cartridge_az" value="{{ old('cartridge_az') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təzyiq aralığı (AZ)</label>
                                                <input type="text" name="pressure_range_az" value="{{ old('pressure_range_az') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Temperatur aralığı (AZ)</label>
                                                <input type="text" name="temperature_range_az" value="{{ old('temperature_range_az') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ölçülər (AZ)</label>
                                                <input type="text" name="dimensions_az" value="{{ old('dimensions_az') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Zəmanət (AZ)</label>
                                                <input type="text" name="warranty_az" value="{{ old('warranty_az') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ölkə (AZ)</label>
                                                <input type="text" name="country_az" value="{{ old('country_az') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Name (EN)</label>
                                                <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control @error('name_en') is-invalid @enderror">
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Cartridge (EN)</label>
                                                <input type="text" name="cartridge_en" value="{{ old('cartridge_en') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Pressure Range (EN)</label>
                                                <input type="text" name="pressure_range_en" value="{{ old('pressure_range_en') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Temperature Range (EN)</label>
                                                <input type="text" name="temperature_range_en" value="{{ old('temperature_range_en') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dimensions (EN)</label>
                                                <input type="text" name="dimensions_en" value="{{ old('dimensions_en') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Warranty (EN)</label>
                                                <input type="text" name="warranty_en" value="{{ old('warranty_en') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Country (EN)</label>
                                                <input type="text" name="country_en" value="{{ old('country_en') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Название (RU)</label>
                                                <input type="text" name="name_ru" value="{{ old('name_ru') }}" class="form-control @error('name_ru') is-invalid @enderror">
                                                @error('name_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Картридж (RU)</label>
                                                <input type="text" name="cartridge_ru" value="{{ old('cartridge_ru') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Диапазон давления (RU)</label>
                                                <input type="text" name="pressure_range_ru" value="{{ old('pressure_range_ru') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Диапазон температур (RU)</label>
                                                <input type="text" name="temperature_range_ru" value="{{ old('temperature_range_ru') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Размеры (RU)</label>
                                                <input type="text" name="dimensions_ru" value="{{ old('dimensions_ru') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Гарантия (RU)</label>
                                                <input type="text" name="warranty_ru" value="{{ old('warranty_ru') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Страна (RU)</label>
                                                <input type="text" name="country_ru" value="{{ old('country_ru') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Qiymət və Taksit bölümü -->
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Qiymət (AZN)</label>
                                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">İllik faiz (%)</label>
                                        <input type="number" step="0.01" name="annual_percentage" value="{{ old('annual_percentage', 0) }}" class="form-control @error('annual_percentage') is-invalid @enderror">
                                        @error('annual_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Taksit ayları</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach([6, 12, 18, 24] as $month)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="installment_months[]" value="{{ $month }}" id="month{{ $month }}" 
                                                    {{ in_array($month, old('installment_months', [])) ? 'checked' : '' }}>
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
                                            <input class="form-check-input" type="checkbox" name="has_courier" id="has_courier" {{ old('has_courier') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_courier">Kuryer xidməti</label>
                                        </div>
                                        <div class="mt-2" id="courier_price_div">
                                            <label class="form-label">Kuryer qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="courier_price" value="{{ old('courier_price') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="has_installation" id="has_installation" {{ old('has_installation') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_installation">Quraşdırılma xidməti</label>
                                        </div>
                                        <div class="mt-2" id="installation_price_div">
                                            <label class="form-label">Quraşdırılma qiyməti (AZN)</label>
                                            <input type="number" step="0.01" name="installation_price" value="{{ old('installation_price') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Şəkillər -->
                                <div class="row mt-4">
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
                                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
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
        const monthlyPayment = price * monthlyRate * Math.pow(1 + monthlyRate, months) / (Math.pow(1 + monthlyRate, months) - 1);
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

document.querySelector('input[name="price"]').addEventListener('input', calculateLoan);
document.querySelector('input[name="annual_percentage"]').addEventListener('input', calculateLoan);
document.querySelectorAll('input[name="installment_months[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', calculateLoan);
});

document.addEventListener('DOMContentLoaded', calculateLoan);

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
                console.log('Alt kategoriler:', response); // Debug için
                var options = '<option value="">Alt kateqoriya seçin</option>';
                response.forEach(function(subCategory) {
                    options += `<option value="${subCategory.id}">${subCategory.name_az}</option>`;
                });
                subCategorySelect.html(options);
            },
            error: function(xhr) {
                console.error('Alt kategoriler yüklenirken hata oluştu:', xhr);
                toastr.error('Alt kategoriler yüklenirken hata oluştu');
            }
        });
    });
});
</script>
@endpush