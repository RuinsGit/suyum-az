@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kateqoriyalar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Kateqoriyalar</li>
                            </ol>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('pages.category.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Yeni Kateqoriya
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">RU</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <!-- AZ Tab -->
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Ad</th>
                                                    <th>Açıqlama</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($category->image)
                                                            <img src="{{ asset($category->image) }}" alt="Category Image" width="50">
                                                        @else
                                                            <span class="text-muted">Şəkil yoxdur</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->name_az }}</td>
                                                    <td>{{ Str::limit($category->description_az, 50) }}</td>
                                                    <td>
                                                        <form action="{{ route('pages.category.toggle-status', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $category->status ? 'success' : 'danger' }}">
                                                                {{ $category->status ? 'Aktiv' : 'Deaktiv' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pages.category.edit', $category->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('pages.category.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- EN Tab -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($category->image)
                                                            <img src="{{ asset($category->image) }}" alt="Category Image" width="50">
                                                        @else
                                                            <span class="text-muted">No image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->name_en }}</td>
                                                    <td>{{ Str::limit($category->description_en, 50) }}</td>
                                                    <td>
                                                        <form action="{{ route('pages.category.toggle-status', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $category->status ? 'success' : 'danger' }}">
                                                                {{ $category->status ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pages.category.edit', $category->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('pages.category.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- RU Tab -->
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Изображение</th>
                                                    <th>Название</th>
                                                    <th>Описание</th>
                                                    <th>Статус</th>
                                                    <th>Операции</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($category->image)
                                                            <img src="{{ asset($category->image) }}" alt="Category Image" width="50">
                                                        @else
                                                            <span class="text-muted">Нет изображения</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->name_ru }}</td>
                                                    <td>{{ Str::limit($category->description_ru, 50) }}</td>
                                                    <td>
                                                        <form action="{{ route('pages.category.toggle-status', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $category->status ? 'success' : 'danger' }}">
                                                                {{ $category->status ? 'Активный' : 'Неактивный' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pages.category.edit', $category->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('pages.category.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: 'Silmək istədiyinizdən əminsiniz?',
                text: "Bu əməliyyatı geri ala bilməzsiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function toggleStatus(categoryId) {
            Swal.fire({
                title: 'Statusu dəyişmək istədiyinizdən əminsiniz?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch(`/admin/category/toggle-status/${categoryId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Status dəyişdirilə bilmədi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: error.message || 'Bir problem yaşandı.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                }
            });
        }
    </script>
@endpush