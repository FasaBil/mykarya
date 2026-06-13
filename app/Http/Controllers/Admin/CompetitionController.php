<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Category; // Wajib dipanggil untuk relasi dropdown
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
    public function index()
    {
        // Menampilkan daftar kompetisi beserta nama kategorinya (Eager Loading)
        $competitions = Competition::with('category')->latest()->paginate(5);
        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        // Mengambil semua data kategori untuk dimasukkan ke dalam elemen <select>
        $categories = Category::all();
        
        // Mencegah user masuk ke form jika belum ada master kategori sama sekali
        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.index')
                             ->with('error', 'Silakan buat minimal satu Kategori terlebih dahulu sebelum menambah Kompetisi.');
        }

        return view('admin.competitions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Server-Side
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // Memastikan ID kategori benar-benar ada di database
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi file gambar maks 2MB
        ], [
            'category_id.required' => 'Kategori lomba wajib dipilih.',
            'title.required' => 'Judul kompetisi wajib diisi.',
            'description.required' => 'Deskripsi kompetisi wajib diisi.',
            'deadline.required' => 'Batas waktu (deadline) wajib diisi.',
            'poster.image' => 'File harus berupa gambar (JPG, JPEG, PNG).',
            'poster.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        // 2. Buat slug otomatis
        $validated['slug'] = Str::slug($validated['title']) . '-' . time(); // Ditambah time() mencegah bentrok jika judul sama

        // 3. Penanganan Upload File Gambar
        if ($request->hasFile('poster')) {
            // File disimpan ke folder storage/app/public/posters
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // 4. Simpan ke database
        Competition::create($validated);

        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Info lomba baru berhasil ditambahkan!');
    }

    public function edit(Competition $competition)
    {
        // Mengirimkan data kategori untuk dropdown dan data kompetisi spesifik
        $categories = Category::all();
        return view('admin.competitions.edit', compact('competition', 'categories'));
    }

    public function update(Request $request, Competition $competition)
    {
        // 1. Validasi Server-Side
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        // 2. Penanganan Update File Gambar (Tantangan Teknis)
        if ($request->hasFile('poster')) {
            // Hapus poster lama dari server jika ada
            if ($competition->poster) {
                Storage::disk('public')->delete($competition->poster);
            }
            // Simpan poster baru
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // 3. Simpan pembaruan ke database
        $competition->update($validated);

        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Info lomba berhasil diupdate!');
    }

    public function destroy(Competition $competition)
    {
        // 1. Hapus gambar fisik dari server sebelum data database dihapus
        if ($competition->poster) {
            Storage::disk('public')->delete($competition->poster);
        }

        // 2. Hapus data dari database
        $competition->delete();

        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Info lomba berhasil dihapus!');
    }
}
