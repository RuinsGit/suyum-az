@extends('back.layouts.master')

@section('title', 'Məhsullar')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsullar</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Məhsullar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistika Kartları -->
        <!-- <div class="row mb-4">
            <div class="col-md-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Ümumi Məhsullar</p>
                                <h4 class="mb-0">{{ $products->total() }}</h4>
                            </div>
                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Aktiv Məhsullar</p>
                                <h4 class="mb-0">{{ $products->where('status', 1)->count() }}</h4>
                            </div>
                            <div class="avatar-sm rounded-circle bg-success align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-success">
                                    <i class="ri-checkbox-circle-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Filtreler -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pages.product.index') }}" method="GET" id="filterForm">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="search-box">
                                        <input type="text" class="form-control" name="search" placeholder="Məhsul axtar..." value="{{ request('search') }}">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select" name="per_page" id="per_page">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 Məhsul</option>
                                        <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 Məhsul</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Məhsul</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Məhsul</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Məhsul</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" name="category" id="category">
                                        <option value="">Bütün kateqoriyalar</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_az }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select" name="status">
                                        <option value="">Bütün statuslar</option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Deaktiv</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-search-line me-1"></i> Axtar
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pages.product.create') }}" class="btn btn-success w-100">
                                        <i class="ri-add-line me-1"></i> Yeni məhsul
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Məhsullar Cədvəli -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th style="width: 100px;">Şəkil</th>
                                        <th>Məhsul</th>
                                        <th>Kateqoriya</th>
                                        <th>Qiymət</th>
                                        <th>Kredit</th>
                                        <th style="width: 120px;">Status</th>
                                        <th style="width: 150px;">Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td class="text-center">{{ $product->id }}</td>
                                            <td>
                                                @if($product->main_image)
                                                    <div class="product-image-container">
                                                        <img src="{{ asset($product->main_image) }}" 
                                                             alt="{{ $product->name_az }}"
                                                             class="img-thumbnail product-image">
                                                    </div>
                                                @else
                                                    <div class="text-center text-muted">
                                                        <i class="ri-image-line" style="font-size: 2rem;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-1">{{ $product->name_az }}</h6>
                                                <small class="text-muted">{{ Str::limit($product->name_en, 30) }}</small>
                                            </td>
                                            <td>{{ optional($product->category)->name_az }}</td>
                                            <td>
                                                @if($product->discount)
                                                    <div class="fw-bold mb-1 font-size-13 text-success">
                                                        {{ number_format($product->price * (1 - $product->discount / 100), 2) }} ₼
                                                    </div>
                                                    <small class="text-danger font-size-13 text-decoration-line-through">
                                                        {{ number_format($product->price, 2) }} ₼
                                                    </small>
                                                    <small class="text-danger d-block">
                                                        <i class="ri-discount-line"></i> {{ $product->discount }}% Endirim
                                                    </small>
                                                @else
                                                    <div class="fw-bold mb-1 ">{{ number_format($product->price, 2) }} ₼</div>
                                                @endif
                                                @if($product->has_courier)
                                                    <small class="text-success d-block">
                                                        <i class="ri-truck-line"></i> Çatdırılma
                                                    </small>
                                                @endif
                                                @if($product->has_installation)
                                                    <small class="text-info d-block">
                                                        <i class="ri-tools-line"></i> Quraşdırma
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->annual_percentage > 0)
                                                    <span class="badge bg-success">{{ $product->annual_percentage }}% illik</span>
                                                    <br>
                                                    
                                                    <div class="btn-group mt-2" role="group" aria-label="Kredi Taksit Seçenekleri">
                                                        @foreach(explode(',', $product->installment_months) as $month)
                                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="calculateAdditionalCost({{ $product->price }}, {{ $product->annual_percentage }}, {{ $month }}, {{ $product->id }})">
                                                                {{ $month }} ay
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                    <small class="text-success d-block mt-2" id="additional-cost-{{ $product->id }}"></small>
                                                @else
                                                    <span class="badge bg-secondary">Kreditsiz</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('pages.product.toggle-status', $product->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-{{ $product->status ? 'success' : 'danger' }}">
                                                        {{ $product->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('pages.product.edit', $product->id) }}" 
                                                       class="btn btn-sm btn-info"
                                                       data-bs-toggle="tooltip"
                                                       title="Redaktə et">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <form action="{{ route('pages.product.destroy', $product->id) }}" 
                                                          method="POST"
                                                          class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Sil">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="ri-inbox-line" style="font-size: 3rem;"></i>
                                                    <h5 class="mt-2">Məhsul tapılmadı</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Səhifələmə -->
                        <div class="d-flex justify-content-end mt-3">
                            @if ($products->hasPages())
                                <nav>
                                    <ul class="pagination mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($products->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">«</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->appends(request()->query())->previousPageUrl() }}" rel="prev">«</a>
                                            </li>
                                        @endif

                                        {{-- Numbered Pages --}}
                                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                                            <li class="page-item {{ ($products->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $products->appends(request()->query())->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Next Page Link --}}
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->appends(request()->query())->nextPageUrl() }}" rel="next">»</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">»</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .search-box {
        position: relative;
    }
    .search-box .search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #74788d;
    }
    .search-box .form-control {
        padding-left: 35px;
    }
    .mini-stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .table > :not(caption) > * > * {
        vertical-align: middle;
    }
    .product-image-container {
        width: 100px;
        height: 100px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Tooltip'ləri aktivləşdir
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Silmə əməliyyatı
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        
        Swal.fire({
            title: 'Diqqət!',
            text: 'Bu məhsulu silmək istədiyinizə əminsiniz?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Bəli, sil!',
            cancelButtonText: 'Xeyr',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Uğurlu!',
                            text: 'Məhsul uğurla silindi',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Xəta!',
                            text: 'Məhsul silinərkən xəta baş verdi',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });

   
    $('#category, select[name="status"]').change(function() {
        $('#filterForm').submit();
    });

    // Auto-submit form when per_page changes
    $('#per_page').change(function() {
        $('#filterForm').submit();
    });
});


function calculateAdditionalCost(price, annualPercentage, months, productId) {
    if (!months) {
        document.getElementById(`additional-cost-${productId}`).innerText = '';
        return;
    }

    
    const monthlyInterestRate = (annualPercentage / 100) / 12; 
    const totalPaid = price * (1 + (monthlyInterestRate * months)); 
    const additionalCost = totalPaid - price; 

    document.getElementById(`additional-cost-${productId}`).innerText = `Əlavə Kredit Gəliri: ${additionalCost.toFixed(2)} ₼`;
}
</script>
@endpush