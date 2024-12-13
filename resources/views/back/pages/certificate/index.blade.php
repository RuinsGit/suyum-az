@extends('back.layouts.master')

@section('title', 'Sertifikatlar')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sertifikatlar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Sertifikatlar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('pages.certificate.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni Sertifikat
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Şəkil</th>
                                            <th>Mətn (AZ)</th>
                                            <th>Text (EN)</th>
                                            <th>Текст (RU)</th>
                                            <th>Status</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($certificates as $certificate)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset($certificate->image) }}" alt="Certificate" 
                                                         style="width: 150px; height: 100px; object-fit: cover;" 
                                                         class="img-thumbnail">
                                                </td>
                                                <td class="html-content">{!! $certificate->text_az !!}</td>
                                                <td class="html-content">{!! $certificate->text_en !!}</td>
                                                <td class="html-content">{!! $certificate->text_ru !!}</td>
                                                <td>
                                                    <form action="{{ route('pages.certificate.toggle-status', $certificate->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-{{ $certificate->status ? 'success' : 'danger' }}">
                                                            {{ $certificate->status ? 'Aktiv' : 'Deaktiv' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages.certificate.edit', $certificate->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('pages.certificate.destroy', $certificate->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Sertifikat tapılmadı</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {{ $certificates->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 