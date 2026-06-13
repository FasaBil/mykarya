@extends('layouts.app')

@section('content')
<style>
    .card-pastel { border: 1px solid rgba(0,0,0,0.03); border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.02); }
    .form-control-pastel, .form-select-pastel { border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 16px; background-color: #f8fafc; transition: all 0.2s; }
    .form-control-pastel:focus, .form-select-pastel:focus { background-color: #fff; border-color: #93c5fd; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
    .form-label-pastel { font-size: 0.875rem; font-weight: 500; color: #475569; margin-bottom: 8px; }
    .btn-pastel { background-color: #3b82f6; color: #fff; border: none; border-radius: 10px; padding: 12px 24px; font-weight: 500; transition: all 0.2s ease; }
    .btn-pastel:hover { background-color: #2563eb; color: #fff; transform: translateY(-2px); }
    .btn-outline-pastel { background-color: transparent; border: 1px solid #e2e8f0; color: #64748b; border-radius: 10px; padding: 10px 20px; font-weight: 500; transition: all 0.2s ease; }
    .btn-outline-pastel:hover { background-color: #f8fafc; color: #334155; }
    .btn-pastel-success { background-color: #10b981; color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; }
    .btn-pastel-success:hover { background-color: #059669; color: #fff; }
</style>

<div class="container py-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-dark fw-bold">Update Progres Karya</h3>
                <a href="{{ route('user.submissions.index') }}" class="btn btn-outline-pastel">Kembali</a>
            </div>

            <div class="card card-pastel bg-white">
                <div class="card-body p-5">
                    
                    <form action="{{ route('user.submissions.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="competition_id" class="form-label-pastel">Info Lomba <span class="text-danger">*</span></label>
                            <select class="form-select form-select-pastel @error('competition_id') is-invalid @enderror" id="competition_id" name="competition_id" required>
                                @foreach($competitions as $competition)
                                    <option value="{{ $competition->id }}" {{ (old('competition_id', $submission->competition_id) == $competition->id) ? 'selected' : '' }}>
                                        {{ $competition->title }} ({{ $competition->category->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('competition_id')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label-pastel">Status Cek Arsip <span class="text-danger">*</span></label>
                            <select class="form-select form-select-pastel @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ $submission->status === 'pending' ? 'selected' : '' }}>Sedang Persiapan</option>
                                <option value="reviewed" {{ $submission->status === 'reviewed' ? 'selected' : '' }}>Menunggu Hasil</option>
                                <option value="approved" {{ $submission->status === 'approved' ? 'selected' : '' }}>Validasi Sertifikat Selesai</option>
                                <option value="rejected" {{ $submission->status === 'rejected' ? 'selected' : '' }}>Belum Berhasil</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="proposal_path" class="form-label-pastel">Update Karya / Proposal (Opsional)</label>
                            <input type="file" class="form-control form-control-pastel @error('proposal_path') is-invalid @enderror" 
                                   id="proposal_path" name="proposal_path" accept="application/pdf">
                            <div class="form-text text-muted mt-2">Kosongkan kalau nggak ada perubahan (Maks 100MB).</div>
                            @error('proposal_path')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-5 border-light">

                        <div class="mb-4">
                            <label for="certificate_path" class="form-label-pastel">Upload Bukti Sertifikat (Buat Validasi Sertifikat)</label>
                            
                            @if($submission->certificate_path)
                                <div class="mb-3">
                                    <a href="{{ asset('storage/' . $submission->certificate_path) }}" target="_blank" class="btn btn-pastel-success">
                                        Cek Sertifikat
                                    </a>
                                </div>
                            @endif

                            <input type="file" class="form-control form-control-pastel @error('certificate_path') is-invalid @enderror" 
                                   id="certificate_path" name="certificate_path" accept="application/pdf, image/jpeg, image/png, image/jpg">
                            <div class="form-text text-muted mt-2">Upload sertifikat pas lomba udah selesai ya. (PDF/JPG/PNG, Maks 100MB).</div>
                            @error('certificate_path')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <button type="submit" class="btn btn-pastel">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection