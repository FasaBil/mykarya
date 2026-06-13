<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionVerificationController extends Controller
{
    public function index()
    {
        // Mengambil SEMUA arsip dari SEMUA mahasiswa, diurutkan dari yang paling baru
        $submissions = Submission::with(['user', 'competition.category'])
                                 ->latest()
                                 ->paginate(10);
                                 
        return view('admin.verifications.index', compact('submissions'));
    }

    public function update(Request $request, Submission $submission)
    {
        // Validasi input status dari Admin
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected'
        ]);

        // Admin mengubah status arsip mahasiswa
        $submission->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Sip, Validasi Sertifikat dan Cek Arsip mahasiswa berhasil diupdate.');
    }
}