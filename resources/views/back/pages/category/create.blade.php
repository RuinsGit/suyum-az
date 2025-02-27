@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kateqoriyalar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('pages.category.index') }}">Kateqoriyalar</a></li>
                                <li class="breadcrumb-item active">Əlavə et</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Kateqoriya əlavə et</h4>

                            <form class="needs-validation" method="POST" action="{{ route('pages.category.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content p-3 text-muted">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="name_az" class="form-label">Ad (AZ)</label>
                                            <input type="text" class="form-control" id="name_az" name="name_az" value="{{ old('name_az') }}" required>
                                            @error('name_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description_az" class="form-label">Açıqlama (AZ)</label>
                                            <textarea class="form-control" id="description_az" name="description_az" rows="3">{{ old('description_az') }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="button_image_alt_az" class="form-label">Düymə Şəkil Alt Mətni (AZ)</label>
                                            <input type="text" class="form-control" id="button_image_alt_az" name="button_image_alt_az" value="{{ old('button_image_alt_az') }}">
                                            @error('button_image_alt_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="name_en" class="form-label">Name (EN)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                                            @error('name_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description_en" class="form-label">Description (EN)</label>
                                            <textarea class="form-control" id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="button_image_alt_en" class="form-label">Button Image Alt Text (EN)</label>
                                            <input type="text" class="form-control" id="button_image_alt_en" name="button_image_alt_en" value="{{ old('button_image_alt_en') }}">
                                            @error('button_image_alt_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label for="name_ru" class="form-label">Название (RU)</label>
                                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}" required>
                                            @error('name_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description_ru" class="form-label">Описание (RU)</label>
                                            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">{{ old('description_ru') }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="button_image_alt_ru" class="form-label">Текст Alt Кнопки (RU)</label>
                                            <input type="text" class="form-control" id="button_image_alt_ru" name="button_image_alt_ru" value="{{ old('button_image_alt_ru') }}">
                                            @error('button_image_alt_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Common Fields -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Şəkil</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="button_image" class="form-label">Alt şəkil</label>
                                    <input type="file" class="form-control" id="button_image" name="button_image">
                                    @error('button_image')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button class="btn btn-primary" type="submit">Təsdiqlə</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Preview image before upload
        document.getElementById('image').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                // Eğer önceki preview varsa kaldır
                let oldPreview = document.getElementById('image-preview');
                if (oldPreview) {
                    oldPreview.remove();
                }

                // Yeni preview oluştur
                let preview = document.createElement('img');
                preview.id = 'image-preview';
                preview.style.maxWidth = '200px';
                preview.style.marginTop = '10px';
                preview.src = URL.createObjectURL(file);
                this.parentNode.appendChild(preview);
            }
        }

        // Preview button image before upload
        document.getElementById('button_image').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                // Eğer önceki preview varsa kaldır
                let oldPreview = document.getElementById('button-image-preview');
                if (oldPreview) {
                    oldPreview.remove();
                }

                // Yeni preview oluştur
                let preview = document.createElement('img');
                preview.id = 'button-image-preview';
                preview.style.maxWidth = '200px';
                preview.style.marginTop = '10px';
                preview.src = URL.createObjectURL(file);
                this.parentNode.appendChild(preview);
            }
        }
    </script>
@endpush