@extends('back.layouts.master')
@section('title', 'Tərcümələr')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Başlık -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Tərcümələr</h4>
                    </div>
                </div>
            </div>

            <!-- Ana İçerik -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('pages.translations.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Logo -->
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Logo</label>
                                            <input type="file" name="logo" class="form-control">
                                            @if($translation && $translation->logo)
                                                <div class="mt-2">
                                                    <img src="{{ asset($translation->logo) }}" alt="Logo" style="max-height: 100px">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Metinler -->
                                @for($i = 1; $i <= 8; $i++)
                                    <div class="row mb-4">
                                        <div class="col-12">
                                           
                                        </div>
                                        
                                        <!-- Azerbaycan (Varsayılan Dil) -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold">
                                                    <i class="fas fa-language me-1"></i> AZ
                                                    <span class="text-primary">(Default)</span>
                                                </label>
                                                <textarea 
                                                    name="text{{$i}}_az" 
                                                    class="form-control" 
                                                    rows="4"
                                                    required
                                                >{{ $translation->{'text'.$i.'_az'} ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <!-- İngilizce -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fas fa-language me-1"></i> EN
                                                </label>
                                                <textarea 
                                                    name="text{{$i}}_en" 
                                                    class="form-control" 
                                                    rows="4"
                                                >{{ $translation->{'text'.$i.'_en'} ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Rusça -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fas fa-language me-1"></i> RU
                                                </label>
                                                <textarea 
                                                    name="text{{$i}}_ru" 
                                                    class="form-control" 
                                                    rows="4"
                                                >{{ $translation->{'text'.$i.'_ru'} ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                                <!-- Kaydet Butonu -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i> Yadda saxla
                                        </button>
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

@section('script')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection