@extends('back.layouts.master')

@section('title', 'Müştərilər')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Müştərilər</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Müştərilər</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="{{ route('pages.customer.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 20%">Şəkil</th>
                                            <th>Link</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customers as $customer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($customer->image)
                                                        <img src="{{ asset($customer->image) }}" alt="Customer Image" 
                                                             class="img-thumbnail" 
                                                             style="width: 150px; height: 100px; object-fit: contain;">
                                                    @else
                                                        <span class="badge bg-warning">Şəkil yoxdur</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($customer->link)
                                                        <a href="{{ $customer->link }}" target="_blank">{{ $customer->link }}</a>
                                                    @else
                                                        <span class="text-muted">Link yoxdur</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('pages.customer.toggle-status', $customer->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-{{ $customer->status ? 'success' : 'danger' }}">
                                                            {{ $customer->status ? 'Aktiv' : 'Deaktiv' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages.customer.edit', $customer->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="deleteData('{{ route('pages.customer.destroy', $customer->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Məlumat tapılmadı</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {{ $customers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('js')
<script>
    function deleteData(url) {
        if (confirm('Silmək istədiyinizə əminsiniz?')) {
            const form = document.getElementById('delete-form');
            form.setAttribute('action', url);
            form.submit();
        }
    }
</script>
@endpush

@push('css')
<style>
    .table td {
        vertical-align: middle;
    }
    .img-thumbnail {
        margin-bottom: 0;
    }
</style>
@endpush 