@extends('layouts.app')

@section('content')
<style>
    .bg-pastel-success { background-color: #f0fdf4; }
    .text-pastel-success { color: #16a34a; }
    .card-pastel { border: 1px solid rgba(0,0,0,0.03); border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.02); }
    .table-pastel th { background-color: transparent; border-bottom: 2px solid #f1f5f9; color: #64748b; font-weight: 500; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .table-pastel td { border-bottom: 1px solid #f8fafc; vertical-align: middle; color: #334155; }
    .form-select-pastel { border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 32px 6px 12px; background-color: #f8fafc; font-size: 0.875rem; color: #475569; transition: all 0.2s; }
    .form-select-pastel:focus { background-color: #fff; border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    .btn-pastel { background-color: #3b82f6; color: #fff; border: none; border-radius: 8px; padding: 6px 16px; font-weight: 500; font-size: 0.875rem; transition: all 0.2s ease; }
    .btn-pastel:hover { background-color: #2563eb; color: #fff; transform: translateY(-1px); }
    .btn-outline-pastel { background-color: transparent; border: 1px solid #e2e8f0; color: #64748b; border-radius: 8px; padding: 6px 12px; font-weight: 500; font-size: 0.8rem; transition: all 0.2s ease; display: inline-block; }
    .btn-outline-pastel:hover { background-color: #f8fafc; color: #334155; border-color: #cbd5e1; }
    .alert-pastel { border-radius: 12px; border: none; }
</style>

<div class="container py-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Cek Arsip & Validasi Sertifikat</h3>
                    <p class="text-muted mb-0">Portal Admin - Cek kelengkapan karya dan Validasi Sertifikat mahasiswa.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-pastel bg-pastel-success text-success mb-4 p-3 shadow-sm" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card card-pastel bg-white">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-pastel align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="20%" class="py-3">Nama Mahasiswa</th>
                                    <th width="25%" class="py-3">Info Lomba & Kategori</th>
                                    <th width="15%" class="text-center py-3">File Karya</th>
                                    <th width="35%" class="py-3">Validasi Sertifikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissions as $submission)
                                    <tr>
                                        <td class="py-3">
                                            <div class="fw-bold text-dark">{{ $submission->user->name }}</div>
                                            <div class="text-muted small mt-1">{{ $submission->user->email }}</div>
                                        </td>
                                        <td class="py-3">
                                            <div class="fw-medium text-dark">{{ $submission->competition->title }}</div>
                                            <div class="text-muted small mt-1">{{ $submission->competition->category->name }}</div>
                                        </td>
                                        <td class="text-center py-3">
                                            <a href="{{ asset('storage/' . $submission->proposal_path) }}" target="_blank" class="btn btn-outline-pastel mb-2 w-100 text-center">
                                                Cek PDF
                                            </a>
                                            @if($submission->certificate_path)
                                                <a href="{{ asset('storage/' . $submission->certificate_path) }}" target="_blank" class="btn btn-outline-pastel border-pastel-success text-pastel-success w-100 text-center">
                                                    Sertifikat
                                                </a>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <form action="{{ route('admin.verifications.update', $submission->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-pastel w-auto flex-grow-1" required>
                                                    <option value="pending" {{ $submission->status === 'pending' ? 'selected' : '' }}>Sedang Persiapan</option>
                                                    <option value="reviewed" {{ $submission->status === 'reviewed' ? 'selected' : '' }}>Menunggu Hasil</option>
                                                    <option value="approved" {{ $submission->status === 'approved' ? 'selected' : '' }}>Validasi Sertifikat Selesai</option>
                                                    <option value="rejected" {{ $submission->status === 'rejected' ? 'selected' : '' }}>Belum Berhasil</option>
                                                </select>
                                                <button type="submit" class="btn btn-pastel">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            Belum ada data karya masuk dari mahasiswa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($submissions->hasPages())
                    <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                        {{ $submissions->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection