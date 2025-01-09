@extends('back.layouts.master')
@section('title', 'Məhsul Müraciətləri')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Məhsul Müraciətləri</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ad Soyad</th>
                                        <th>Məhsul</th>
                                        <th>E-poçt</th>
                                        <th>Telefon</th>
                                        <th>Status</th>
                                        <th>Tarix</th>
                                        <th>İşləmlər</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($applications as $application)
                                        <tr>
                                            <td>{{ $application->id }}</td>
                                            <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                            <td>{{ $application->product->name_az }}</td>
                                            <td>{{ $application->email }}</td>
                                            <td>{{ $application->phone }}</td>
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
                                            <td>{{ $application->created_at->setTimezone('Asia/Baku')->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('pages.product-applications.show', $application->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('pages.product-applications.destroy', $application->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Müraciət yoxdur.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $applications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection