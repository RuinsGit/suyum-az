@extends('admin.layouts.master')
@section('title', 'Logo Yönetimi')
@section('content')

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Logo Ayarları</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pages.logo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control">
                    @if($logo && $logo->logo)
                        <img src="{{ asset($logo->logo) }}" alt="Logo" class="mt-2" style="max-height: 100px">
                    @endif
                </div>

                <div class="form-group">
                    <label>Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    @if($logo && $logo->favicon)
                        <img src="{{ asset($logo->favicon) }}" alt="Favicon" class="mt-2" style="max-height: 32px">
                    @endif
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="status" {{ ($logo && $logo->status) ? 'checked' : '' }}>
                        Aktif
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>
</div>

@endsection 