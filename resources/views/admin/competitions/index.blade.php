@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-12"> <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-dark fw-bold">Katalog Kompetisi</h3>
                <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary shadow-sm">
                    + Tambah Kompetisi Baru
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
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center py-3">No</th>
                                    <th width="10%" class="text-center py-3">Poster</th>
                                    <th width="25%" class="py-3">Judul Kompetisi</th>
                                    <th width="15%" class="py-3">Kategori</th>
                                    <th width="15%" class="py-3">Batas Akhir</th>
                                    <th width="15%" class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($competitions as $index => $competition)
                                    <tr>
                                        <td class="text-center">{{ $competitions->firstItem() + $index }}</td>
                                        <td class="text-center">
                                            @if($competition->poster)
                                                <img src="{{ asset('storage/' . $competition->poster) }}" 
                                                     alt="Poster" class="img-thumbnail" style="width: 60px; height: 80px; object-fit: cover;">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="fw-medium">
                                            {{ $competition->title }}<br>
                                            <small class="text-muted">{{ Str::limit($competition->description, 40) }}</small>
                                        </td>
                                        <td><span class="badge bg-info text-dark">{{ $competition->category->name }}</span></td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($competition->deadline)->format('d M Y, H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.competitions.edit', $competition->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            
                                            <form action="{{ route('admin.competitions.destroy', $competition->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kompetisi ini? File poster fisik juga akan terhapus permanen.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            Belum ada data kompetisi. Silakan tambahkan informasi kompetisi baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($competitions->hasPages())
                    <div class="card-footer bg-white pt-3 pb-0">
                        {{ $competitions->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection