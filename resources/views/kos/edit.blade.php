<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Kos: ') }} {{ $kos->nama_kos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT') {{-- WAJIB: Berfungsi memberi tahu Laravel bahwa ini adalah proses UPDATE --}}

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kos</label>
                        <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga Per Bulan (Rp)</label>
                        <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kos->harga_per_bulan) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('alamat', $kos->alamat) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas (Pisahkan dengan koma)</label>
                        <input type="text" name="fasilitas" value="{{ old('fasilitas', $kos->fasilitas) }}" placeholder="Contoh: AC, Wifi, Kamar Mandi Dalam" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No. WhatsApp Pemilik</label>
                        <input type="text" name="kontak_pemilik" value="{{ old('kontak_pemilik', $kos->kontak_pemilik) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Kos Baru (Kosongkan jika tidak ingin diubah)</label>
                        
                        @if($kos->foto)
                            <div class="mb-2">
                                <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $kos->foto) }}" alt="Foto lama" class="w-32 h-24 object-cover rounded border">
                            </div>
                        @endif

                        <input type="file" name="foto" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">*Format: jpg, jpeg, png (Max 2MB)</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Kos</label>
                        <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-200">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>