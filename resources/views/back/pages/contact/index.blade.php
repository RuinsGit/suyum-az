@extends('back.layouts.master')
@section('title', 'Əlaqə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Əlaqə</h4>
                        <div class="page-title-right">
                            <a href="{{ route('pages.contact.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Yeni əlavə et
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Filial Adı</th>
                                            <th>Nömrə</th>
                                            <th>Email</th>
                                            <th>Ünvan</th>
                                            <th>İkonlar</th>
                                            <th>Status</th>
                                            <th>Filial Məlumatı</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div><strong>AZ:</strong> {{ $contact->name_az }}</div>
                                                    <div><strong>EN:</strong> {{ $contact->name_en }}</div>
                                                    <div><strong>RU:</strong> {{ $contact->name_ru }}</div>
                                                </td>
                                                <td>
                                                    <div><strong>AZ:</strong> {{ $contact->number_az }}</div>
                                                    <div><strong>EN:</strong> {{ $contact->number_en }}</div>
                                                    <div><strong>RU:</strong> {{ $contact->number_ru }}</div>
                                                </td>
                                                <td>
                                                    <div><strong>AZ:</strong> {{ $contact->email_az }}</div>
                                                    <div><strong>EN:</strong> {{ $contact->email_en }}</div>
                                                    <div><strong>RU:</strong> {{ $contact->email_ru }}</div>
                                                </td>
                                                <td>
                                                    <div><strong>AZ:</strong> {{ $contact->address_az }}</div>
                                                    <div><strong>EN:</strong> {{ $contact->address_en }}</div>
                                                    <div><strong>RU:</strong> {{ $contact->address_ru }}</div>
                                                </td>
                                                <td>
                                                    <div class="mb-2">
                                                        @if($contact->number_image)
                                                            <img src="{{ asset($contact->number_image) }}" alt="Nömrə İkonu" height="30">
                                                        @else
                                                            <span class="text-muted">Nömrə ikonu yoxdur</span>
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        @if($contact->address_image)
                                                            <img src="{{ asset($contact->address_image) }}" alt="Ünvan İkonu" height="30">
                                                        @else
                                                            <span class="text-muted">Ünvan ikonu yoxdur</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if($contact->email_image)
                                                            <img src="{{ asset($contact->email_image) }}" alt="Email İkonu" height="30">
                                                        @else
                                                            <span class="text-muted">Email ikonu yoxdur</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-{{ $contact->status ? 'success' : 'danger' }}"
                                                            onclick="toggleStatus({{ $contact->id }})">
                                                        {{ $contact->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div><strong>AZ:</strong> {{ Str::limit($contact->filial_text_az, 50) }}</div>
                                                    <div><strong>EN:</strong> {{ Str::limit($contact->filial_text_en, 50) }}</div>
                                                    <div><strong>RU:</strong> {{ Str::limit($contact->filial_text_ru, 50) }}</div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages.contact.edit', ['id' => $contact->id]) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('pages.contact.destroy', ['id' => $contact->id]) }}" 
                                                          method="POST" 
                                                          class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                            <i class="fas fa-trash"></i>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function toggleStatus(id) {
            if (confirm('Statusu dəyişdirmək istədiyinizə əminsiniz?')) {
                fetch(`/admin/pages/contact/toggle-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
