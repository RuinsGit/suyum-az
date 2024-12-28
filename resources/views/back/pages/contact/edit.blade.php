@extends('back.layouts.master')

@section('title', 'Əlaqə Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Əlaqə Redaktə</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.contact.update', ['id' => $contact->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (AZ)</label>
                                            <input type="text" class="form-control" name="name_az" value="{{ old('name_az', $contact->name_az) }}" required>
                                            @error('name_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (EN)</label>
                                            <input type="text" class="form-control" name="name_en" value="{{ old('name_en', $contact->name_en) }}" required>
                                            @error('name_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Adı (RU)</label>
                                            <input type="text" class="form-control" name="name_ru" value="{{ old('name_ru', $contact->name_ru) }}" required>
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
                                            <input type="text" class="form-control" name="number_az" value="{{ old('number_az', $contact->number_az) }}" required>
                                            @error('number_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə (EN)</label>
                                            <input type="text" class="form-control" name="number_en" value="{{ old('number_en', $contact->number_en) }}" required>
                                            @error('number_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nömrə (RU)</label>
                                            <input type="text" class="form-control" name="number_ru" value="{{ old('number_ru', $contact->number_ru) }}" required>
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
                                            <input type="email" class="form-control" name="email_az" value="{{ old('email_az', $contact->email_az) }}" required>
                                            @error('email_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email (EN)</label>
                                            <input type="email" class="form-control" name="email_en" value="{{ old('email_en', $contact->email_en) }}" required>
                                            @error('email_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email (RU)</label>
                                            <input type="email" class="form-control" name="email_ru" value="{{ old('email_ru', $contact->email_ru) }}" required>
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
                                            <input type="text" class="form-control" name="address_az" value="{{ old('address_az', $contact->address_az) }}" required>
                                            @error('address_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan (EN)</label>
                                            <input type="text" class="form-control" name="address_en" value="{{ old('address_en', $contact->address_en) }}" required>
                                            @error('address_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan (RU)</label>
                                            <input type="text" class="form-control" name="address_ru" value="{{ old('address_ru', $contact->address_ru) }}" required>
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
                                            @if($contact->number_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset($contact->number_image) }}" alt="" style="height: 50px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="number_image">
                                            @error('number_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ünvan İkonu</label>
                                            @if($contact->address_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset($contact->address_image) }}" alt="" style="height: 50px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="address_image">
                                            @error('address_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email İkonu</label>
                                            @if($contact->email_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset($contact->email_image) }}" alt="" style="height: 50px;">
                                                </div>
                                            @endif
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
                                            <textarea class="form-control" name="filial_text_az" rows="4">{{ old('filial_text_az', $contact->filial_text_az) }}</textarea>
                                            @error('filial_text_az')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Google Map (EN)</label>
                                            <textarea class="form-control" name="filial_text_en" rows="4">{{ old('filial_text_en', $contact->filial_text_en) }}</textarea>
                                            @error('filial_text_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Google Map (RU)</label>
                                            <textarea class="form-control" name="filial_text_ru" rows="4">{{ old('filial_text_ru', $contact->filial_text_ru) }}</textarea>
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