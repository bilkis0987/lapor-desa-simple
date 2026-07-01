<x-public-layout>
    <div>
        <div class="bg-white">
            <div class="relative bg-gradient-to-r from-primary-700 to-primary-900">
                <div class="absolute inset-0">
                    <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="Desa">
                    <div class="absolute inset-0 bg-primary-900 mix-blend-multiply"></div>
                </div>
                <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        LaporDesa
                    </h1>
                    <p class="mt-6 text-xl text-primary-100 max-w-3xl mx-auto">
                        Sarana Pengaduan Masyarakat untuk Pembangunan dan Perbaikan Sarana Desa
                    </p>
                    <div class="mt-10 flex justify-center gap-4">
                        <a href="{{ route('pengaduan.buat') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                            Buat Pengaduan
                        </a>
                        <a href="{{ route('pengaduan.lacak') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                            Lacak Pengaduan
                        </a>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="bg-primary-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-primary-600">{{ $totalComplaints }}</div>
                        <div class="mt-2 text-sm font-medium text-primary-800">Total Pengaduan</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-green-600">{{ $resolvedComplaints }}</div>
                        <div class="mt-2 text-sm font-medium text-green-800">Selesai</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-yellow-600">{{ $inProgressComplaints }}</div>
                        <div class="mt-2 text-sm font-medium text-yellow-800">Diproses</div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Kategori Sarana Desa</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                        <div class="border rounded-lg p-4 text-center hover:shadow-md transition">
                            <div class="text-2xl mb-2">
                                @switch($category->icon)
                                    @case('road') 🛣️ @break
                                    @case('lightbulb') 💡 @break
                                    @case('droplet') 💧 @break
                                    @case('waves') 🌊 @break
                                    @case('building') 🏛️ @break
                                    @case('trash') 🗑️ @break
                                    @default 📋
                                @endswitch
                            </div>
                            <div class="font-medium text-gray-900">{{ $category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $category->complaints_count }} pengaduan</div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($recentComplaints->count() > 0)
                <div class="bg-gray-50 py-12">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Pengaduan Terbaru</h2>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($recentComplaints as $complaint)
                                <div class="bg-white rounded-lg shadow p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-medium px-2 py-1 rounded-full 
                                            @if($complaint->status == 'resolved') bg-green-100 text-green-800
                                            @elseif($complaint->status == 'in_progress') bg-yellow-100 text-yellow-800
                                            @elseif($complaint->status == 'verified') bg-blue-100 text-blue-800
                                            @elseif($complaint->status == 'rejected') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $complaint->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="font-semibold text-gray-900">{{ $complaint->title }}</h3>
                                    <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $complaint->description }}</p>
                                    <div class="mt-3 flex items-center justify-between text-sm">
                                        <span class="text-primary-600">{{ $complaint->category->name }}</span>
                                        <a href="{{ route('pengaduan.detail', $complaint) }}" class="text-primary-600 hover:text-primary-800 font-medium">Detail</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-primary-800 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-2xl font-bold text-white">Ada keluhan tentang sarana desa?</h2>
                    <p class="mt-4 text-primary-200">Sampaikan pengaduan Anda sekarang, dan kami akan segera menindaklanjuti.</p>
                    <div class="mt-6">
                        <a href="{{ route('pengaduan.buat') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-primary-800 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                            Sampaikan Pengaduan
                        </a>
                    </div>
                </div>
            </div>

            <footer class="bg-gray-900 text-white py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} LaporDesa. Sistem Pengaduan Sarana Desa.</p>
                </div>
            </footer>
        </div>
    </div>
</x-public-layout>

{{-- TODO: Add carousel images for hero section --}}