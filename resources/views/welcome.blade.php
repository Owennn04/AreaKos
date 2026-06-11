<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AreaKos - Cari Kos Idamanmu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-blue-600">AreaKos</h1>
                </div>
                <div>
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Dashboard Saya</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">Daftar Pemilik Kos</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-blue-600 py-16 text-center shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-white mb-4">Temukan Kos Idamanmu di AreaKos</h2>
            <p class="text-xl text-blue-100">Nyaman, aman, dan pastinya sesuai dengan *budget* kamu.</p>
        </div>
    </header>

    <main class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h3 class="text-2xl font-bold text-gray-800 mb-6 px-4 sm:px-0">Daftar Kos Terbaru</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-0">
            @forelse ($kos as $item)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama_kos }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada foto</div>
                    @endif
                    
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama_kos }}</h4>
                        <p class="text-blue-600 font-semibold mb-4">Rp {{ number_format($item->harga_per_bulan, 0, ',', '.') }} / bulan</p>
                        
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3" title="{{ $item->deskripsi }}">
                            {{ $item->deskripsi }}
                        </p>
                        
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <span class="font-semibold mr-2">Fasilitas:</span>
                                <span class="text-xs bg-green-100 text-green-800 py-0.5 px-2 rounded">{{ $item->fasilitas }}</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold">Alamat:</span> {{ $item->alamat }}
                            </div>
                            <div class="text-sm text-gray-600 flex items-center mt-2">
                                <span class="font-semibold mr-1">Minat? Hubungi:</span> 
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak_pemilik) }}" target="_blank" class="text-green-600 hover:underline font-bold flex items-center">
                                    🟢 Chat Pemilik
                                </a>
                            </div>
                            @if($item->link_gmaps)
                            <div class="text-sm mt-3 border-t border-gray-100 pt-3">
                                <a href="{{ $item->link_gmaps }}" target="_blank" class="inline-flex items-center justify-center w-full bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded-md transition duration-200">
                                    📍 Buka di Google Maps
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-lg shadow-sm text-center">
                    <p class="text-gray-500 mb-2 text-lg">Belum ada kos yang terdaftar saat ini.</p>
                    <p class="text-gray-400">Jadilah yang pertama mendaftarkan properti kos Anda!</p>
                </div>
            @endforelse
        </div>

    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} AreaKos. Semua Hak Cipta Dilindungi.
    </footer>

</body>
</html>