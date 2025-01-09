@extends('back.layouts.master')
@section('title', 'Müraciət Detalları')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Müraciət Detalları</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('pages.product-applications.index') }}">Müraciətlər</a>
                        </li>
                        <li class="breadcrumb-item active">Detal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Müraciət Məlumatları</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Müraciət ID</th>
                                    <td>{{ $application->id }}</td>
                                </tr>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>E-poçt</th>
                                    <td>{{ $application->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>{{ $application->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <form action="{{ route('pages.product-applications.toggle-status', $application->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-sm {{ $application->status ? 'btn-success' : 'btn-danger' }}">
                                                {{ $application->status ? 'Baxıldı' : 'Gözləmədə' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tarix</th>
                                    <td>{{ $application->created_at->setTimezone('Asia/Baku')->format('d-m-Y H:i') }}</td>
                                </tr>
                                @if($application->message)
                                <tr>
                                    <th>Mesaj</th>
                                    <td>{{ $application->message }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Məhsul Məlumatları</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if($application->product->main_image)
                                    <div class="product-image-container" style="
                                        background: #f8f9fa;
                                        padding: 15px;
                                        border-radius: 8px;
                                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 140px;
                                        height: 140px;
                                        margin-bottom: 10px;
                                    ">
                                        <img src="{{ asset($application->product->main_image) }}" 
                                             alt="Məhsul Şəkli" 
                                             style="
                                                max-width: 110px;
                                                max-height: 110px;
                                                width: auto;
                                                height: auto;
                                                object-fit: contain;
                                                transition: transform 0.3s ease;
                                             "
                                             onmouseover="this.style.transform='scale(1.1)'"
                                             onmouseout="this.style.transform='scale(1)'">
                                    </div>
                                @endif
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Məhsul ID</th>
                                    <td>{{ $application->product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Məhsul Adı (AZ)</th>
                                    <td>{{ $application->product->name_az }}</td>
                                </tr>
                                <tr>
                                    <th>Məhsul Adı (EN)</th>
                                    <td>{{ $application->product->name_en }}</td>
                                </tr>
                                <tr>
                                    <th>Məhsul Adı (RU)</th>
                                    <td>{{ $application->product->name_ru }}</td>
                                </tr>
                                <tr>
                                    <th>Kateqoriya</th>
                                    <td>{{ $application->product->category->name_az ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alt Kateqoriya</th>
                                    <td>{{ $application->product->subCategory->name_az ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Qiymət</th>
                                    <td>{{ number_format($application->product->price, 2) }} ₼</td>
                                </tr>
                                @if($application->product->discount)
                                <tr>
                                    <th>Endirim</th>
                                    <td>{{ $application->product->discount }}%</td>
                                </tr>
                                @endif
                                @if($application->product->has_courier)
                                <tr>
                                    <th>Çatdırılma Haqqı</th>
                                    <td>{{ number_format($application->product->courier_price, 2) }} ₼</td>
                                </tr>
                                @endif
                                @if($application->product->has_installation)
                                <tr>
                                    <th>Quraşdırma Haqqı</th>
                                    <td>{{ number_format($application->product->installation_price, 2) }} ₼</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('pages.product-applications.index') }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Geri Qayıt
                            </a>
                            <form action="{{ route('pages.product-applications.destroy', $application->id) }}" 
                                  method="POST" 
                                  class="d-inline float-right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger" 
                                        onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                    <i class="fas fa-trash"></i> Sil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 