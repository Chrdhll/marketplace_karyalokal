<?php

namespace App\Http\Controllers\Freelancer;

use App\Models\Gig;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GigController extends Controller
{
    /**
     * Menampilkan daftar semua Gigs milik freelancer.
     */
    public function index()
    {
        $gigs = Auth::user()->gigs()->latest()->paginate(10);
        return view('freelancer.gigs.index', compact('gigs'));
    }

    /**
     * Menampilkan form untuk membuat Gig baru.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('freelancer.gigs.create', compact('categories'));
    }

    /**
     * Menyimpan Gig baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'estimated_time' => 'required|string|max:50',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        if ($request->hasFile('cover_image')) {
            $validated['cover_image_path'] = $request->file('cover_image')->store('gig-covers', 'public');
        }

        Auth::user()->gigs()->create($validated);

        return redirect()->route('freelancer.gigs.index')->with('success', 'Jasa berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu Gig (opsional, bisa diskip jika tidak perlu).
     */
    public function show(Gig $gig)
    {
        // Biasanya untuk halaman detail publik, tapi kita bisa buat juga untuk freelancer
        return view('freelancer.gigs.show', compact('gig'));
    }

    /**
     * Menampilkan form untuk mengedit Gig.
     */
    public function edit(Gig $gig)
    {
        // Keamanan: Pastikan freelancer hanya bisa mengedit gig miliknya sendiri
        if ($gig->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $categories = Category::orderBy('name', 'asc')->get(); // Ambil semua kategori
        return view('freelancer.gigs.edit', compact('gig', 'categories'));
    }

    /**
     * Meng-update Gig yang sudah ada di database.
     */
    public function update(Request $request, Gig $gig)
    {
        // Keamanan: Pastikan freelancer hanya bisa mengupdate gig miliknya sendiri
        if ($gig->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'estimated_time' => 'required|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $dataToUpdate = $request->only(['title', 'description', 'price', 'estimated_time', 'category_id']);

        if ($request->has('title')) {
            $dataToUpdate['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . uniqid();
        }

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama sebelum upload yang baru
            if ($gig->cover_image_path) {
                Storage::disk('public')->delete($gig->cover_image_path);
            }
            $dataToUpdate['cover_image_path'] = $request->file('cover_image')->store('gig-covers', 'public');
        }

        $gig->update($dataToUpdate);

        return redirect()->route('freelancer.gigs.index')->with('success', 'Jasa (Gig) berhasil diperbarui!');
    }

    /**
     * Menghapus Gig dari database.
     */
    public function destroy(Gig $gig)
    {
        // Keamanan: Pastikan freelancer hanya bisa menghapus gig miliknya sendiri
        if ($gig->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // Hapus gambar dari storage
        if ($gig->cover_image_path) {
            Storage::disk('public')->delete($gig->cover_image_path);
        }

        $gig->delete();

        return redirect()->route('freelancer.gigs.index')->with('success', 'Jasa (Gig) berhasil dihapus!');
    }
}
