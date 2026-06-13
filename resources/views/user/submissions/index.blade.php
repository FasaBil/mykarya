@extends('layouts.app')

@section('content')
<style>
    .bg-pastel-primary { background-color: #f0f4ff; }
    .bg-pastel-success { background-color: #f0fdf4; }
    .bg-pastel-warning { background-color: #fffbeb; }
    .bg-pastel-danger { background-color: #fef2f2; }
    .text-pastel-primary { color: #3b82f6; }
    .text-pastel-success { color: #16a34a; }
    .text-pastel-warning { color: #d97706; }
    .text-pastel-danger { color: #dc2626; }
    .card-pastel { border: 1px solid rgba(0,0,0,0.03); border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.02); }
    .table-pastel th { background-color: transparent; border-bottom: 2px solid #f1f5f9; color: #64748b; font-weight: 500; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .table-pastel td { border-bottom: 1px solid #f8fafc; vertical-align: middle; color: #334155; }
    .hover-lift { transition: transform 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); }
    .btn-pastel { background-color: #3b82f6; color: #fff; border: none; border-radius: 10px; padding: 8px 20px; font-weight: 500; transition: all 0.2s ease; }
    .btn-pastel:hover { background-color: #2563eb; color: #fff; transform: translateY(-2px); }
    .btn-outline-pastel { background-color: transparent; border: 1px solid #e2e8f0; color: #64748b; border-radius: 8px; padding: 6px 16px; font-weight: 500; transition: all 0.2s ease; }
    .btn-outline-pastel:hover { background-color: #f8fafc; color: #334155; border-color: #cbd5e1; }
    .badge-soft { padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 0.8rem; }
    .alert-pastel { border-radius: 12px; border: none; }
</style>

<div class="container py-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Riwayat Lapor Progres Lomba</h3>
                    <p class="text-muted mb-0">Pantau progres dan arsip karya kamu di sini.</p>
                </div>
                <a href="{{ route('user.submissions.create') }}" class="btn btn-pastel shadow-sm hover-lift">
                    Upload Karya Baru
                </a>
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
                                    <th width="25%" class="py-3">Info Lomba & Kategori</th>
                                    <th width="15%" class="text-center py-3">File Karya</th>
                                    <th width="15%" class="text-center py-3">Bukti Sertifikat</th>
                                    <th width="20%" class="text-center py-3">Status Cek Arsip</th>
                                    <th width="20%" class="text-end py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissions as $submission)
                                    <tr>
                                        <td class="py-3">
                                            <div class="fw-bold text-dark">{{ $submission->competition->title }}</div>
                                            <div class="text-muted small mt-1">{{ $submission->competition->category->name }}</div>
                                        </td>
                                        <td class="text-center py-3">
                                            <a href="{{ asset('storage/' . $submission->proposal_path) }}" target="_blank" class="btn btn-sm btn-outline-pastel">
                                                Buka PDF
                                            </a>
                                        </td>
                                        <td class="text-center py-3">
                                            @if($submission->certificate_path)
                                                <a href="{{ asset('storage/' . $submission->certificate_path) }}" target="_blank" class="btn btn-sm btn-outline-pastel text-pastel-success border-pastel-success">Lihat Sertifikat</a>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center py-3">
                                            @if($submission->status === 'pending')
                                                <span class="badge badge-soft bg-pastel-warning text-pastel-warning">Sedang Persiapan</span>
                                            @elseif($submission->status === 'reviewed')
                                                <span class="badge badge-soft bg-pastel-primary text-pastel-primary">Menunggu Hasil</span>
                                            @elseif($submission->status === 'approved')
                                                <span class="badge badge-soft bg-pastel-success text-pastel-success">Validasi Sertifikat Selesai</span>
                                            @else
                                                <span class="badge badge-soft bg-pastel-danger text-pastel-danger">Belum Berhasil</span>
                                            @endif
                                        </td>
                                        <td class="text-end py-3">
                                            <a href="{{ route('user.submissions.edit', $submission->id) }}" class="btn btn-sm btn-outline-pastel me-2">Update</a>
                                            
                                            <form action="{{ route('user.submissions.destroy', $submission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-pastel text-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            Belum ada riwayat karya nih. Yuk, mulai Upload Karya kamu sekarang!
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