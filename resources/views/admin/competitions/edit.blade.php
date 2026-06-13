@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-dark fw-bold">Edit Kompetisi</h3>
                <a href="{{ route('admin.competitions.index') }}" class="btn btn-secondary shadow-sm">
                    Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.competitions.update', $competition->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT') <div class="mb-3">
                            <label for="category_id" class="form-label fw-medium">Kategori Lomba <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $competition->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label fw-medium">Judul Kompetisi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $competition->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label fw-medium">Batas Akhir (Deadline) <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" 
                                   id="deadline" name="deadline" value="{{ old('deadline', date('Y-m-d\TH:i', strtotime($competition->deadline))) }}" required>
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poster" class="form-label fw-medium">Ganti Poster (Opsional)</label>
                            
                            @if($competition->poster)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $competition->poster) }}" alt="Poster Saat Ini" class="img-thumbnail" style="max-height: 150px;">
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah poster.</div>
                                </div>
                            @endif

                            <input type="file" class="form-control @error('poster') is-invalid @enderror" 
                                   id="poster" name="poster" accept="image/png, image/jpeg, image/jpg">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-medium">Detail / Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $competition->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4">Update Kompetisi</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection