<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index()
    {
        // Hanya mengambil data arsip milik user yang sedang login
        $submissions = Submission::with('competition.category')
                                 ->where('user_id', Auth::id())
                                 ->latest()
                                 ->paginate(5);
                                 
        return view('user.submissions.index', compact('submissions'));
    }

    public function create()
    {
        // Mengambil daftar kompetisi untuk dipilih oleh mahasiswa
        $competitions = Competition::latest()->get();
        
        if ($competitions->isEmpty()) {
            return redirect()->route('dashboard')
                             ->with('error', 'Ups, belum ada Info Lomba yang tersedia buat kamu upload karya.');
        }

        return view('user.submissions.create', compact('competitions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'proposal_path' => 'required|file|mimes:pdf|max:102400', 
        ], [
            'competition_id.required' => 'Pilih kompetisi yang diikuti.',
            'proposal_path.required' => 'File proposal wajib diunggah.',
            'proposal_path.mimes' => 'Format file harus berupa PDF.',
            'proposal_path.max' => 'Ukuran file maksimal 100MB.'
        ]);

        $path = $request->file('proposal_path')->store('proposals', 'public');

        Submission::create([
            'user_id' => Auth::id(),
            'competition_id' => $validated['competition_id'],
            'proposal_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('user.submissions.index')
                         ->with('success', 'Mantap! Progres karya kamu udah kecatat di Jejak Karya!');
    }

    public function edit(Submission $submission)
    {
        // Keamanan tambahan: Pastikan user hanya bisa edit arsip miliknya sendiri
        if ($submission->user_id !== Auth::id()) {
            abort(403, 'Oops! Kamu nggak bisa akses halaman ini.');
        }

        $competitions = Competition::latest()->get();
        return view('user.submissions.edit', compact('submission', 'competitions'));
    }

    public function update(Request $request, Submission $submission)
    {
        // Keamanan: Cek kepemilikan data
        if ($submission->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'proposal_path' => 'nullable|file|mimes:pdf|max:102400', // max 100MB
            'certificate_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:102400', // max 100MB
            'status' => 'required|in:pending,reviewed,approved,rejected'
        ]);

        // Jika user mengganti proposal lama
        if ($request->hasFile('proposal_path')) {
            Storage::disk('public')->delete($submission->proposal_path);
            $validated['proposal_path'] = $request->file('proposal_path')->store('proposals', 'public');
        }

        // Jika user mengunggah sertifikat (baru/update)
        if ($request->hasFile('certificate_path')) {
            if ($submission->certificate_path) {
                Storage::disk('public')->delete($submission->certificate_path);
            }
            $validated['certificate_path'] = $request->file('certificate_path')->store('certificates', 'public');
        }

        $submission->update($validated);

        return redirect()->route('user.submissions.index')
                         ->with('success', 'Sip! Progres dan berkas kamu udah berhasil diupdate!');
    }

    public function destroy(Submission $submission)
    {
        // Keamanan: Cek kepemilikan data
        if ($submission->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus semua file fisik yang menempel
        Storage::disk('public')->delete($submission->proposal_path);
        if ($submission->certificate_path) {
            Storage::disk('public')->delete($submission->certificate_path);
        }

        $submission->delete();

        return redirect()->route('user.submissions.index')
                         ->with('success', 'Oke, data progres karya kamu udah dihapus.');
    }
}
