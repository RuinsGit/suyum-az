@extends('back.layouts.master')

@section('title', 'Əlaqə Müraciətləri')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Əlaqə Müraciətləri</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Əlaqə Müraciətləri</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if($messages->count() > 0)
                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-danger delete-selected" style="display: none;">
                                            <i class="fas fa-trash"></i> Seçilənləri Sil
                                        </button>
                                    </div>
                                @endif
                                
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                @if($messages->count() > 0)
                                                    <input type="checkbox" class="form-check-input" id="select-all">
                                                @endif
                                            </th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Mesaj</th>
                                            <th>Tarix</th>
                                            <th>Status</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($messages as $message)
                                            <tr class="{{ $message->status ? '' : 'table-active' }}">
                                                <td>
                                                    <input type="checkbox" class="form-check-input message-checkbox" value="{{ $message->id }}">
                                                </td>
                                                <td>{{ $message->name }}</td>
                                                <td>{{ $message->surname }}</td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ $message->phone }}</td>
                                                <td>{{ Str::limit($message->message, 50) }}</td>
                                                <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    @if($message->status)
                                                        <span class="badge bg-success">Oxunub</span>
                                                    @else
                                                        <span class="badge bg-danger">Oxunmayıb</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages.contact-form.show', $message->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($message->status)
                                                        <form action="{{ route('pages.contact-form.mark-as-unread', $message->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-envelope"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('pages.contact-form.mark-as-read', $message->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fas fa-envelope-open"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('pages.contact-form.destroy', $message->id) }}" method="POST" class="d-inline-block">
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
                                                <td colspan="9" class="text-center">Müraciət tapılmadı</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {{ $messages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Tümünü seç/kaldır
        $('#select-all').on('change', function() {
            $('.message-checkbox').prop('checked', $(this).prop('checked'));
            toggleDeleteSelected();
        });

        // Tekil seçimler için kontrol
        $('.message-checkbox').on('change', function() {
            toggleDeleteSelected();
        });

        // Seçilenleri sil butonu görünürlüğü
        function toggleDeleteSelected() {
            if ($('.message-checkbox:checked').length > 0) {
                $('.delete-selected').show();
            } else {
                $('.delete-selected').hide();
            }
        }

        // Seçilenleri sil
        $('.delete-selected').on('click', function() {
            if (confirm('Seçili mesajları silmək istədiyinizə əminsiniz?')) {
                var selectedIds = [];
                $('.message-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('pages.contact-form.bulk-delete') }}",
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        ids: selectedIds.join(',')
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush 