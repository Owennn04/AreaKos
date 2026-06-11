<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pemilik Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex justify-end">
                <a href="{{ route('kos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-200">
                    + Tambah Kos Baru
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kos as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama_kos }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada foto</div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama_kos }}</h3>
                            <p class="text-blue-600 font-semibold mb-4">Rp {{ number_format($item->harga_per_bulan, 0, ',', '.') }} / bulan</p>
                            
                            <p class="text-gray-700 text-sm mb-4 line-clamp-2" title="{{ $item->deskripsi }}">
                                {{ $item->deskripsi }}
                            </p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-xs bg-green-100 text-green-800 py-1 px-2 rounded">{{ $item->fasilitas }}</span>
                                <span class="text-xs text-gray-500">{{ $item->alamat }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-8 rounded-lg shadow-sm text-center">
                        <p class="text-gray-500 mb-4">Kamu belum memiliki data kos.</p>
                        <a href="{{ route('kos.create') }}" class="text-blue-600 underline hover:text-blue-800">Silakan tambah kos pertamamu di sini!</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>