<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kos Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('kos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Keamanan wajib Laravel untuk mencegah serangan CSRF --}}

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kos</label>
                        <input type="text" name="nama_kos" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga Per Bulan (Rp)</label>
                        <input type="number" name="harga_per_bulan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas (Pisahkan dengan koma)</label>
                        <input type="text" name="fasilitas" placeholder="Contoh: AC, Wifi, Kamar Mandi Dalam" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No. WhatsApp Pemilik (Format: 08xxx atau 62xxx)</label>
                        <input type="text" name="kontak_pemilik" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Kos</label>
                        <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Kos</label>
                        <input type="file" name="foto" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">*Format: jpg, jpeg, png (Max 2MB)</p>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-200">
                            Simpan Kos
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>