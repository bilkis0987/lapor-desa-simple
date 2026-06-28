<x-public-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Detail Pengaduan #{{ $complaint->id }}</h2>
                        <a href="{{ route('home') }}" class="text-sm text-primary-600 hover:text-primary-800">Kembali</a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-primary-50 border-2 border-primary-300 rounded-lg p-4 mb-6 text-center">
                        <p class="text-sm text-primary-700 font-medium">ID PENGADUAN ANDA</p>
                        <p class="text-3xl font-bold text-primary-800 mt-1 select-all">#{{ $complaint->id }}</p>
                        <p class="text-xs text-primary-600 mt-1">Simpan ID ini untuk melacak status pengaduan</p>
                    </div>

                    <div class="border rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                @if($complaint->status == 'resolved') bg-green-100 text-green-800
                                @elseif($complaint->status == 'in_progress') bg-yellow-100 text-yellow-800
                                @elseif($complaint->status == 'verified') bg-blue-100 text-blue-800
                                @elseif($complaint->status == 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($complaint->priority == 'urgent') bg-red-100 text-red-800
                                @elseif($complaint->priority == 'high') bg-orange-100 text-orange-800
                                @elseif($complaint->priority == 'medium') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($complaint->priority) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <span class="text-gray-500">Kategori:</span>
                                <span class="font-medium">{{ $complaint->category->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Tanggal:</span>
                                <span class="font-medium">{{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Pelapor:</span>
                                <span class="font-medium">{{ $complaint->complainant_name }}</span>
                            </div>
                            @if($complaint->location)
                            <div>
                                <span class="text-gray-500">Lokasi:</span>
                                <span class="font-medium">{{ $complaint->location }}</span>
                            </div>
                            @endif
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $complaint->title }}</h3>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $complaint->description }}</p>

                        @if($complaint->image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $complaint->image) }}" alt="Foto Pengaduan" class="max-w-full rounded-lg">
                            </div>
                        @endif

                        @if($complaint->admin_note)
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm font-medium text-blue-800">Catatan Admin:</p>
                                <p class="text-sm text-blue-700">{{ $complaint->admin_note }}</p>
                            </div>
                        @endif
                    </div>

                    @if($complaint->comments->count() > 0)
                        <div class="border rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tanggapan ({{ $complaint->comments->count() }})</h3>
                            @foreach($complaint->comments as $comment)
                                <div class="border-b border-gray-100 pb-3 mb-3 last:border-0 last:mb-0 last:pb-0">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                        <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-1 text-gray-700">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
