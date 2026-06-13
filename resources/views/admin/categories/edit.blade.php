@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-dark fw-bold">Edit Kategori</h3>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary shadow-sm">
                    Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf 
                        @method('PUT') <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $category->name) }}" required>
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-medium">Deskripsi (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4">Update Kategori</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection