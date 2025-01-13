@extends('back.layouts.master')
@section('title', 'Logo Tənzimləmələri')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Logo Tənzimləmələri</h4>
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
                                        <th>Logo</th>
                                        <th>Favicon</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($logo)
                                        <tr>
                                            <td>
                                                @if($logo->logo)
                                                    <img src="{{ asset($logo->logo) }}" alt="Logo" style="max-height: 50px">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($logo->favicon)
                                                    <img src="{{ asset($logo->favicon) }}" alt="Favicon" style="max-height: 32px">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('pages.logo.toggle-status', $logo->id) }}" method="POST" class="d-inline status-form">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $logo->status ? 'success' : 'danger' }}">
                                                        {{ $logo->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateLogoModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateLogoModal" tabindex="-1" aria-labelledby="updateLogoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateLogoModalLabel">Logo Yenilə</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pages.logo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($logo && $logo->logo)
                                <div class="mt-2">
                                    <img src="{{ asset($logo->logo) }}" alt="Logo" class="img-fluid" style="max-height: 100px">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                            @if($logo && $logo->favicon)
                                <div class="mt-2">
                                    <img src="{{ asset($logo->favicon) }}" alt="Favicon" class="img-fluid" style="max-height: 32px">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="status-form" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection 