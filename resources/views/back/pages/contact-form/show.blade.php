@extends('back.layouts.master')

@section('title', 'Müraciət Detalları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Müraciət Detalları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pages.contact-form.index') }}">Müraciətlər</a></li>
                                <li class="breadcrumb-item active">Detal</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Müraciət Məlumatları</h4>
                                <div>
                                    @if($contactForm->status)
                                        <form action="{{ route('pages.contact-form.mark-as-unread', $contactForm->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-envelope me-1"></i> Oxunmamış kimi işarələ
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('pages.contact-form.mark-as-read', $contactForm->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-envelope-open me-1"></i> Oxunmuş kimi işarələ
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('pages.contact-form.destroy', $contactForm->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                            <i class="fas fa-trash me-1"></i> Sil
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px;">Ad</th>
                                            <td>{{ $contactForm->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Soyad</th>
                                            <td>{{ $contactForm->surname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                <a href="mailto:{{ $contactForm->email }}">{{ $contactForm->email }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Telefon</th>
                                            <td>
                                                <a href="tel:{{ $contactForm->phone }}">{{ $contactForm->phone }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tarix</th>
                                            <td>{{ $contactForm->created_at->format('d.m.Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if($contactForm->status)
                                                    <span class="badge bg-success">Oxunub</span>
                                                @else
                                                    <span class="badge bg-danger">Oxunmayıb</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mesaj</th>
                                            <td>{{ $contactForm->message }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('pages.contact-form.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Geri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection