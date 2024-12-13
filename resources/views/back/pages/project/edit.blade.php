@extends('back.layouts.master')

@section('title', 'Layihə Redaktə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Layihə Redaktə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pages.project.index') }}">Layihələr</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pages.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Şəkil</label>
                                        @if($project->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($project->image) }}" alt="Current Image" 
                                                     class="img-thumbnail" style="max-height: 150px">
                                            </div>
                                        @endif
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alt Şəkillər</label>
                                        
                                        <!-- Mevcut resimler -->
                                        @if($project->bottom_images)
                                            <div class="existing-images mb-3">
                                                <div class="row">
                                                    @foreach($project->bottom_images as $key => $image)
                                                        <div class="col-md-3 mb-2">
                                                            <div class="position-relative">
                                                                <img src="{{ asset($image) }}" alt="Gallery Image" 
                                                                     class="img-thumbnail" 
                                                                     style="height: 150px; width: 100%; object-fit: cover;">
                                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-existing-image" 
                                                                        data-image-key="{{ $key }}">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Yeni resimler ekleme -->
                                        <div class="bottom-images-container">
                                            <div class="bottom-image-row mb-2">
                                                <div class="input-group">
                                                    <input type="file" name="bottom_images[]" class="form-control">
                                                    <button type="button" class="btn btn-danger remove-image" style="display: none;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success mt-2" id="add-more-images">
                                            <i class="fas fa-plus"></i> Şəkil əlavə et
                                        </button>
                                    </div>
                                </div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Ad</label>
                                                <input type="text" name="name_az" class="form-control @error('name_az') is-invalid @enderror" 
                                                       value="{{ old('name_az', $project->name_az) }}">
                                                @error('name_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Layihə</label>
                                                    <textarea name="text1_az" class="form-control summernote @error('text1_az') is-invalid @enderror">{{ old('text1_az', $project->text1_az) }}</textarea>
                                                    @error('text1_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Layihə Açıqlama</label>
                                                    <textarea name="description1_az" class="form-control summernote @error('description1_az') is-invalid @enderror">{{ old('description1_az', $project->description1_az) }}</textarea>
                                                    @error('description1_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Görülən işlər</label>
                                                    <textarea name="text2_az" class="form-control summernote @error('text2_az') is-invalid @enderror">{{ old('text2_az', $project->text2_az) }}</textarea>
                                                    @error('text2_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Görülən işlər Açıqlama</label>
                                                    <textarea name="description2_az" class="form-control summernote @error('description2_az') is-invalid @enderror">{{ old('description2_az', $project->description2_az) }}</textarea>
                                                    @error('description2_az')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" 
                                                       value="{{ old('name_en', $project->name_en) }}">
                                                @error('name_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Project</label>
                                                    <textarea name="text1_en" class="form-control summernote @error('text1_en') is-invalid @enderror">{{ old('text1_en', $project->text1_en) }}</textarea>
                                                    @error('text1_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Project Disclosure</label>
                                                    <textarea name="description1_en" class="form-control summernote @error('description1_en') is-invalid @enderror">{{ old('description1_en', $project->description1_en) }}</textarea>
                                                    @error('description1_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Work done</label>
                                                    <textarea name="text2_en" class="form-control summernote @error('text2_en') is-invalid @enderror">{{ old('text2_en', $project->text2_en) }}</textarea>
                                                    @error('text2_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Details of the work done</label>
                                                    <textarea name="description2_en" class="form-control summernote @error('description2_en') is-invalid @enderror">{{ old('description2_en', $project->description2_en) }}</textarea>
                                                    @error('description2_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Название</label>
                                                <input type="text" name="name_ru" class="form-control @error('name_ru') is-invalid @enderror" 
                                                       value="{{ old('name_ru', $project->name_ru) }}">
                                                @error('name_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Проект</label>
                                                    <textarea name="text1_ru" class="form-control summernote @error('text1_ru') is-invalid @enderror">{{ old('text1_ru', $project->text1_ru) }}</textarea>
                                                    @error('text1_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Раскрытие информации о проекте</label>
                                                    <textarea name="description1_ru" class="form-control summernote @error('description1_ru') is-invalid @enderror">{{ old('description1_ru', $project->description1_ru) }}</textarea>
                                                    @error('description1_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Выполненные работы</label>
                                                    <textarea name="text2_ru" class="form-control summernote @error('text2_ru') is-invalid @enderror">{{ old('text2_ru', $project->text2_ru) }}</textarea>
                                                    @error('text2_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Детали выполненных работ</label>
                                                    <textarea name="description2_ru" class="form-control summernote @error('description2_ru') is-invalid @enderror">{{ old('description2_ru', $project->description2_ru) }}</textarea>
                                                    @error('description2_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('pages.project.index') }}" class="btn btn-secondary">Ləğv et</a>
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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .img-thumbnail {
        max-width: 200px;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Yeni resim alanı ekleme
        $('#add-more-images').click(function() {
            var newRow = `
                <div class="bottom-image-row mb-2">
                    <div class="input-group">
                        <input type="file" name="bottom_images[]" class="form-control">
                        <button type="button" class="btn btn-danger remove-image">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            $('.bottom-images-container').append(newRow);
        });

        // Yeni resim alanını silme
        $(document).on('click', '.remove-image', function() {
            $(this).closest('.bottom-image-row').remove();
        });

        // Mevcut resimleri silme
        $('.delete-existing-image').click(function() {
            if(confirm('Bu şəkili silmək istədiyinizə əminsiniz?')) {
                var key = $(this).data('image-key');
                $(this).closest('.col-md-3').remove();
                
                // Silinen resimleri takip etmek için hidden input ekle
                $('<input>').attr({
                    type: 'hidden',
                    name: 'remove_images[]',
                    value: key
                }).appendTo('form');
            }
        });
    });
</script>
@endpush 