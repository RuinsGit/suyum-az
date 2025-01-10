@extends('back.layouts.master')
@section('title', 'SEO Siyahısı')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">SEO Siyahısı</h4>
                        <div class="page-title-right">
                            @if($seos->count() < 11)
                                <a href="{{ route('pages.seo.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Meta Title (AZ)</th>
                                        <th>Meta Description (AZ)</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seos as $seo)
                                        <tr>
                                            <td>{{ $seo->key }}</td>
                                            <td>{{ $seo->meta_title_az }}</td>
                                            <td>{{ Str::limit($seo->meta_description_az, 50) }}</td>
                                            <td>
                                                <form action="{{ route('pages.seo.toggle-status', $seo->id) }}" method="POST" class="d-inline status-form">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $seo->status ? 'success' : 'danger' }}">
                                                        {{ $seo->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('pages.seo.edit', $seo->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="deleteData('{{ route('pages.seo.destroy', $seo->id) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button> -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-form" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    <form id="status-form" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Status değiştirme işlemi
            $('.status-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            var button = form.find('button');
                            var newStatus = !button.hasClass('btn-outline-success');
                            
                            button.removeClass('btn-outline-success btn-outline-danger')
                                .addClass(newStatus ? 'btn-outline-success' : 'btn-outline-danger')
                                .text(newStatus ? 'Aktiv' : 'Deaktiv');
                            
                            // Toast bildirimi
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#fff',
                                color: '#000'
                            });

                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        }
                    }
                });
            });

            // Silme işlemi için
            window.deleteData = function(url) {
                Swal.fire({
                    title: "Əminsiniz?",
                    text: "Silinən məlumat geri qaytarılmır!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Bəli, sil!",
                    cancelButtonText: "Xeyr",
                    background: '#fff',
                    color: '#000'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-form');
                        form.setAttribute('action', url);
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection 