@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık ve Üst Kısım -->
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

        <!-- Filtreler ve Arama -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pages.product.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="search" placeholder="Məhsul axtar..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" name="category">
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
                                        <i class="ri-search-line"></i> Axtar
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('pages.product.create') }}" class="btn btn-success w-100">
                                        <i class="ri-add-line"></i> Yeni məhsul
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
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th style="width: 100px;">Şəkil</th>
                                        <th>Məhsul</th>
                                        <th>Kateqoriya</th>
                                        <th>Qiymət</th>
                                        <th>Kredit</th>
                                        <th>Status</th>
                                        <th style="width: 150px;">Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <img src="{{ asset($product->main_image) }}" 
                                                     alt="{{ $product->name_az }}"
                                                     class="img-thumbnail"
                                                     style="max-width: 80px;">
                                            </td>
                                            <td>
                                                <h6 class="mb-1">{{ $product->name_az }}</h6>
                                                <small class="text-muted">
                                                    {{ Str::limit($product->name_en, 30) }}
                                                </small>
                                            </td>
                                            <td>{{ $product->category->name_az }}</td>
                                            <td>
                                                <span class="fw-bold">{{ number_format($product->price, 2) }} AZN</span>
                                                @if($product->has_courier)
                                                    <br>
                                                    <small class="text-success">
                                                        <i class="ri-truck-line"></i> Çatdırılma
                                                    </small>
                                                @endif
                                                @if($product->has_installation)
                                                    <br>
                                                    <small class="text-info">
                                                        <i class="ri-tools-line"></i> Quraşdırma
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->annual_percentage > 0)
                                                    <span class="badge bg-success">{{ $product->annual_percentage }}% illik</span>
                                                    <br>
                                                    <small>{{ $product->installment_months }} ay</small>
                                                @else
                                                    <span class="badge bg-secondary">Kreditsiz</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" 
                                                           class="form-check-input status-switch"
                                                           data-id="{{ $product->id }}"
                                                           {{ $product->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('pages.product.edit', $product->id) }}" 
                                                       class="btn btn-sm btn-info">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-primary view-details"
                                                            data-id="{{ $product->id }}">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                    <form action="{{ route('pages.product.destroy', $product->id) }}" 
                                                          method="POST"
                                                          class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Məhsul tapılmadı</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Məhsul Detayları Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Məhsul Detalları</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- AJAX ile doldurulacak -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
// Status değiştirme
$('.status-switch').change(function() {
    const id = $(this).data('id');
    const status = $(this).prop('checked') ? 1 : 0;
    
    $.ajax({
        url: `/admin/product/${id}/status`,
        type: 'POST',
        data: { status, _token: '{{ csrf_token() }}' },
        success: function(response) {
            toastr.success('Status uğurla dəyişdirildi');
        },
        error: function() {
            toastr.error('Xəta baş verdi');
            $(this).prop('checked', !status);
        }
    });
});

// Silme işlemi onayı
$('.delete-form').submit(function(e) {
    e.preventDefault();
    if (confirm('Bu məhsulu silmək istədiyinizə əminsiniz?')) {
        this.submit();
    }
});

// Məhsul detayları modalı
$('.view-details').click(function() {
    const id = $(this).data('id');
    
    $.get(`/admin/product/${id}/details`, function(response) {
        $('#productDetailsModal .modal-body').html(response);
        $('#productDetailsModal').modal('show');
    });
});
</script>
@endpush