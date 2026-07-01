<x-public-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Lacak Pengaduan</h2>

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="text-gray-600 mb-4">Cari pengaduan berdasarkan nama atau judul.</p>

                    <form method="GET" action="{{ route('pengaduan.lacak') }}">
                        <div class="flex gap-2">
                            <input type="text" name="search" placeholder="Cari nama atau judul pengaduan..." value="{{ request('search') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" required>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                                Cari
                            </button>
                        </div>
                    </form>

                    @if($complaints->isNotEmpty())
                        <div class="mt-6 space-y-3">
                            <p class="text-sm text-gray-500">Ditemukan {{ $complaints->count() }} pengaduan:</p>
                            @foreach($complaints as $complaint)
                                <a href="{{ route('pengaduan.detail', $complaint) }}" class="block border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-900">{{ $complaint->title }}</span>
                                        <span class="text-xs text-gray-500">#{{ $complaint->id }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 mt-1 text-sm text-gray-500">
                                        <span>{{ $complaint->complainant_name }}</span>
                                        <span>&middot;</span>
                                        <span>{{ $complaint->category->name }}</span>
                                        <span>&middot;</span>
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                            @if($complaint->status == 'resolved') bg-green-100 text-green-800
                                            @elseif($complaint->status == 'in_progress') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @elseif(request('search'))
                        <p class="mt-4 text-gray-500 text-center">Tidak ada hasil untuk pencarian "{{ request('search') }}"</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

{{-- TODO: Add real-time tracking status bar --}}