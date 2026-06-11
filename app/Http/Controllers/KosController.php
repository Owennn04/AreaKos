<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}