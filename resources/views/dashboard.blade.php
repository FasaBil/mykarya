@extends('layouts.app')

@section('content')
<style>
    /* Pastel Theme & Minimalist UI */
    .bg-pastel-primary { background-color: #f0f4ff; }
    .bg-pastel-success { background-color: #f0fdf4; }
    .bg-pastel-warning { background-color: #fffbeb; }
    .bg-pastel-danger { background-color: #fef2f2; }
    .text-pastel-primary { color: #3b82f6; }
    .border-pastel-primary { border-color: #bfdbfe; }
    .card-pastel { border: 1px solid rgba(0,0,0,0.05); border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.02); }
    .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.05); }
    .btn-pastel { background-color: #3b82f6; color: #fff; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 500; transition: all 0.2s ease; }
    .btn-pastel:hover { background-color: #2563eb; color: #fff; transform: translateY(-2px); }
    .btn-outline-pastel { background-color: transparent; border: 1px solid #bfdbfe; color: #3b82f6; border-radius: 10px; padding: 10px 24px; font-weight: 500; transition: all 0.2s ease; }
    .btn-outline-pastel:hover { background-color: #f0f4ff; border-color: #3b82f6; }
    .badge-soft { padding: 6px 12px; border-radius: 8px; font-weight: 500; letter-spacing: 0.3px; }
    .alert-pastel { border-radius: 12px; border: none; }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-pastel">
                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success alert-pastel bg-pastel-success text-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-5">
                        <h3 class="mb-2 fw-bold text-dark">Halo, {{ $user->name }}!</h3>
                        <p class="text-muted mb-0">
                            Status akun: 
                            <span class="badge badge-soft {{ $user->role === 'admin' ? 'bg-pastel-danger text-danger' : 'bg-pastel-success text-success' }} ms-1">
                                {{ $user->role === 'admin' ? 'Admin' : 'Mahasiswa' }}
                            </span>
                        </p>
                    </div>

                    @if($user->role === 'admin')
                        <div class="alert alert-pastel bg-pastel-primary text-pastel-primary p-4 mb-4">
                            <h5 class="fw-bold mb-2">Portal Admin Jejak Karya</h5>
                            <p class="mb-0">Di sini kamu bisa kelola Info Lomba dan Cek Arsip mahasiswa dengan mudah.</p>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-pastel hover-lift">
                                Kategori Lomba
                            </a>
                            <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-pastel hover-lift">
                                Lomba Rekomendasi
                            </a>
                            <a href="{{ route('admin.verifications.index') }}" class="btn btn-pastel hover-lift">
                                Validasi Sertifikat
                            </a>
                        </div>
                    @else
                        <div class="alert alert-pastel bg-pastel-primary text-pastel-primary p-4 mb-4">
                            <h5 class="fw-bold mb-2">Portal Mahasiswa</h5>
                            <p class="mb-0">Yuk, Upload Karya kamu! Kumpulkan riwayat progres dan Validasi Sertifikat biar prestasimu tercatat di Jejak Karya.</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.submissions.index') }}" class="btn btn-pastel hover-lift">
                                Lapor Progres Lomba
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection