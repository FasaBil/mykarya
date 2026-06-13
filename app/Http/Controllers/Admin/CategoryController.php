<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini untuk memanipulasi string (slug)

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        // Menampilkan halaman form tambah kategori
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Server-Side
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah digunakan, silakan gunakan nama lain.',
            'name.max' => 'Nama kategori maksimal 100 karakter.'
        ]);

        // 2. Pembuatan Slug Otomatis (contoh: "Web Design" menjadi "web-design")
        $validated['slug'] = Str::slug($validated['name']);

        // 3. Simpan ke database
        Category::create($validated);

        // 4. Redirect kembali ke halaman index dengan membawa alert sukses
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori lomba berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        // Menampilkan halaman form edit dengan membawa data kategori spesifik
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // 1. Validasi Server-Side (Pengecualian unique untuk ID kategori yang sedang diedit)
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah digunakan.',
            'name.max' => 'Nama kategori maksimal 100 karakter.'
        ]);

        // 2. Perbarui slug jika nama berubah
        $validated['slug'] = Str::slug($validated['name']);

        // 3. Simpan perubahan ke database
        $category->update($validated);

        // 4. Redirect dengan alert
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori lomba berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        // Hapus data dari database
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori lomba berhasil dihapus!');
    }
}
