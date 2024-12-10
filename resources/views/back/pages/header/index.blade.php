@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Başlıqlar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Başlıqlar</li>
                            </ol>
                        </div>
                    </div>
                    <div class="mb-3">
                        @if($headers->count() == 0)
                            <a href="{{ route('pages.header.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus"></i> Yeni Başlıq
                            </a>
                        @endif
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
                                                    <th>Ana Səhifə</th>
                                                    <th>Haqqımızda</th>
                                                    <th>Məhsullar</th>
                                                    <th>Xidmətlər</th>
                                                    <th>Layihələr</th>
                                                    <th>Sertifikatlar</th>
                                                    <th>Müştərilər</th>
                                                    <th>Əlaqə</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($headers as $header)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $header->home_az }}</td>
                                                    <td>{{ $header->about_az }}</td>
                                                    <td>{{ $header->products_az }}</td>
                                                    <td>{{ $header->services_az }}</td>
                                                    <td>{{ $header->projects_az }}</td>
                                                    <td>{{ $header->certificates_az }}</td>
                                                    <td>{{ $header->customers_az }}</td>
                                                    <td>{{ $header->contact_az }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.header.edit', $header->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <!-- <form action="{{ route('pages.header.destroy', $header->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form> -->
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
                                                    <th>Home</th>
                                                    <th>About</th>
                                                    <th>Products</th>
                                                    <th>Services</th>
                                                    <th>Projects</th>
                                                    <th>Certificates</th>
                                                    <th>Customers</th>
                                                    <th>Contact</th>
                                                    <th>Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($headers as $header)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $header->home_en }}</td>
                                                    <td>{{ $header->about_en }}</td>
                                                    <td>{{ $header->products_en }}</td>
                                                    <td>{{ $header->services_en }}</td>
                                                    <td>{{ $header->projects_en }}</td>
                                                    <td>{{ $header->certificates_en }}</td>
                                                    <td>{{ $header->customers_en }}</td>
                                                    <td>{{ $header->contact_en }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.header.edit', $header->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <!-- <form action="{{ route('pages.header.destroy', $header->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form> -->
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
                                                    <th>Главная</th>
                                                    <th>О нас</th>
                                                    <th>Продукты</th>
                                                    <th>Услуги</th>
                                                    <th>Проекты</th>
                                                    <th>Сертификаты</th>
                                                    <th>Клиенты</th>
                                                    <th>Контакты</th>
                                                    <th>Операции</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($headers as $header)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $header->home_ru }}</td>
                                                    <td>{{ $header->about_ru }}</td>
                                                    <td>{{ $header->products_ru }}</td>
                                                    <td>{{ $header->services_ru }}</td>
                                                    <td>{{ $header->projects_ru }}</td>
                                                    <td>{{ $header->certificates_ru }}</td>
                                                    <td>{{ $header->customers_ru }}</td>
                                                    <td>{{ $header->contact_ru }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.header.edit', $header->id) }}" class="btn btn-success">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <!-- <form action="{{ route('pages.header.destroy', $header->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this.form)">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form> -->
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{ $headers->links('pagination::bootstrap-5') }}
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
    </script>
@endpush