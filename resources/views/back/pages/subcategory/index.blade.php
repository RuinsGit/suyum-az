@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Alt Kateqoriyalar</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('pages.subcategory.index') }}">Alt Kateqoriyalar</a></li>
                            <li class="breadcrumb-item active">Siyahı</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('pages.subcategory.create') }}" class="btn btn-primary">Yeni Alt Kateqoriya</a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Əsas Kateqoriya</th>
                                    <th>Ad (AZ)</th>
                                    <th>Ad (EN)</th>
                                    <th>Ad (RU)</th>
                                    <th>Status</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCategories as $subCategory)
                                <tr>
                                    <td>{{ $subCategory->id }}</td>
                                    <td>{{ $subCategory->category->name_az }}</td>
                                    <td>{{ $subCategory->name_az }}</td>
                                    <td>{{ $subCategory->name_en }}</td>
                                    <td>{{ $subCategory->name_ru }}</td>
                                    <td>
                                        <form action="{{ route('pages.subcategory.toggle-status', $subCategory->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-{{ $subCategory->status ? 'success' : 'danger' }}">
                                                {{ $subCategory->status ? 'Aktiv' : 'Deaktiv' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('pages.subcategory.edit', $subCategory->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pages.subcategory.destroy', $subCategory->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Əminsiniz?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $subCategories->onEachSide(2)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 