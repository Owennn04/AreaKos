<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    // 1. Menampilkan halaman form tambah kos
    public function create()
    {
        return view('kos.create');
    }

    // 2. Menyimpan data kos ke database
    public function store(Request $request)
{
    $request->validate([
        'nama_kos' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga_per_bulan' => 'required|integer',
        'alamat' => 'required|string',
        'fasilitas' => 'required|string',
        'kontak_pemilik' => 'required|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto (max 2MB)
    ]);

    $data = $request->all();

    // Logika upload foto
    if ($request->hasFile('foto')) {
        // Simpan file ke folder storage/app/public/foto-kos
        $path = $request->file('foto')->store('foto-kos', 'public');
        $data['foto'] = $path;
    }

    // Hubungkan dengan user ID yang login
    $data['user_id'] = Auth::id();

    // Simpan ke database
    Kos::create($data);

    return redirect()->route('dashboard')->with('success', 'Kos berhasil ditambahkan!');
}
    // 3. Menampilkan halaman form edit
    public function edit(Kos $kos)
    {
        // Keamanan: Pastikan hanya pemilik asli yang bisa edit
        if ($kos->user_id !== auth()->id()) {
            abort(403, 'Akses Ditolak');
        }
        return view('kos.edit', compact('kos'));
    }

    // 4. Menyimpan perubahan data (Update)
    public function update(Request $request, Kos $kos)
    {
        if ($kos->user_id !== auth()->id()) {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_per_bulan' => 'required|integer',
            'alamat' => 'required|string',
            'fasilitas' => 'required|string',
            'kontak_pemilik' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Jika user mengupload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari laptop
            if ($kos->foto) {
                Storage::disk('public')->delete($kos->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('foto-kos', 'public');
        }

        $kos->update($data);

        return redirect()->route('dashboard')->with('success', 'Data kos berhasil diubah!');
    }

    // 5. Menghapus data kos (Delete)
    public function destroy(Kos $kos)
    {
        if ($kos->user_id !== auth()->id()) {
            abort(403, 'Akses Ditolak');
        }

        // Hapus file foto dari laptop
        if ($kos->foto) {
            Storage::disk('public')->delete($kos->foto);
        }

        // Hapus data dari database
        $kos->delete();

        return redirect()->route('dashboard')->with('success', 'Data kos berhasil dihapus!');
    }
}