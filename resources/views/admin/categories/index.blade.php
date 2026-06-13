@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-dark fw-bold">Manajemen Kategori</h3>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-sm">
                    + Tambah Kategori Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center py-3">No</th>
                                    <th width="25%" class="py-3">Nama Kategori</th>
                                    <th width="20%" class="py-3">Slug (URL)</th>
                                    <th width="35%" class="py-3">Deskripsi</th>
                                    <th width="15%" class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td class="text-center align-middle">{{ $categories->firstItem() + $index }}</td>
                                        <td class="align-middle fw-medium">{{ $category->name }}</td>
                                        <td class="align-middle text-muted">{{ $category->slug }}</td>
                                        <td class="align-middle">{{ Str::limit($category->description, 50) }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Peringatan: Semua kompetisi yang ada di dalam kategori ini akan ikut terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Belum ada data kategori. Silakan tambahkan kategori baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($categories->hasPages())
                    <div class="card-footer bg-white pt-3 pb-0">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection