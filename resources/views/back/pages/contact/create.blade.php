@extends('back.layouts.master')

@section('title', 'Yeni Əlaqə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Yeni Əlaqə</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('pages.contact.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (AZ)</label>
                                            <input type="text" class="form-control" name="name_az" value="{{ old('name_az') }}" required>
                                            @error('name_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (EN)</label>
                                            <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" required>
                                            @error('name_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (RU)</label>
                                            <input type="text" class="form-control" name="name_ru" value="{{ old('name_ru') }}" required>
                                            @error('name_ru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə (AZ)</label>
                                            <input type="text" class="form-control" name="number_az" value="{{ old('number_az') }}" required>
                                            @error('number_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə (EN)</label>
                                            <input type="text" class="form-control" name="number_en" value="{{ old('number_en') }}" required>
                                            @error('number_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə (RU)</label>
                                            <input type="text" class="form-control" name="number_ru" value="{{ old('number_ru') }}" required>
                                            @error('number_ru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email (AZ)</label>
                                            <input type="email" class="form-control" name="email_az" value="{{ old('email_az') }}" required>
                                            @error('email_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email (EN)</label>
                                            <input type="email" class="form-control" name="email_en" value="{{ old('email_en') }}" required>
                                            @error('email_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email (RU)</label>
                                            <input type="email" class="form-control" name="email_ru" value="{{ old('email_ru') }}" required>
                                            @error('email_ru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan (AZ)</label>
                                            <input type="text" class="form-control" name="address_az" value="{{ old('address_az') }}" required>
                                            @error('address_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan (EN)</label>
                                            <input type="text" class="form-control" name="address_en" value="{{ old('address_en') }}" required>
                                            @error('address_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan (RU)</label>
                                            <input type="text" class="form-control" name="address_ru" value="{{ old('address_ru') }}" required>
                                            @error('address_ru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə İkonu</label>
                                            <input type="file" class="form-control" name="number_image">
                                            @error('number_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan İkonu</label>
                                            <input type="file" class="form-control" name="address_image">
                                            @error('address_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email İkonu</label>
                                            <input type="file" class="form-control" name="email_image">
                                            @error('email_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <h4>Filial Məlumatları</h4>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Google Map (AZ)</label>
                                            <textarea class="form-control" name="filial_text_az" rows="4">{{ old('filial_text_az') }}</textarea>
                                            @error('filial_text_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Google Map (EN)</label>
                                            <textarea class="form-control" name="filial_text_en" rows="4">{{ old('filial_text_en') }}</textarea>
                                            @error('filial_text_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Google Map (RU)</label>
                                            <textarea class="form-control" name="filial_text_ru" rows="4">{{ old('filial_text_ru') }}</textarea>
                                            @error('filial_text_ru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 