<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengaduan #{{ $complaint->id }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.complaints.edit', $complaint) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.complaints.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
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
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($complaint->priority) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><span class="text-gray-500">Kategori:</span> <span class="font-medium">{{ $complaint->category->name }}</span></div>
                    <div><span class="text-gray-500">Tanggal:</span> <span class="font-medium">{{ $complaint->created_at->format('d/m/Y H:i') }}</span></div>
                    <div><span class="text-gray-500">Nama:</span> <span class="font-medium">{{ $complaint->complainant_name }}</span></div>
                    <div><span class="text-gray-500">Telepon:</span> <span class="font-medium">{{ $complaint->complainant_phone ?? '-' }}</span></div>
                    <div><span class="text-gray-500">Email:</span> <span class="font-medium">{{ $complaint->complainant_email ?? '-' }}</span></div>
                    @if($complaint->location)<div><span class="text-gray-500">Lokasi:</span> <span class="font-medium">{{ $complaint->location }}</span></div>@endif
                </div>

                <h3 class="text-lg font-semibold mb-2">{{ $complaint->title }}</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $complaint->description }}</p>

                @if($complaint->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $complaint->image) }}" alt="Foto" class="max-w-md rounded-lg">
                    </div>
                @endif

                @if($complaint->admin_note)
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm font-medium text-blue-800">Catatan Admin:</p>
                        <p class="text-sm text-blue-700">{{ $complaint->admin_note }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Tanggapan</h3>

                @if($complaint->comments->count() > 0)
                    @foreach($complaint->comments as $comment)
                        <div class="border-b border-gray-100 pb-3 mb-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 text-gray-700">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-sm">Belum ada tanggapan.</p>
                @endif

                <form method="POST" action="{{ route('admin.complaints.comments', $complaint) }}" class="mt-4">
                    @csrf
                    <textarea name="comment" rows="2" placeholder="Tulis tanggapan..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required></textarea>
                    <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">Kirim</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.complaints.destroy', $complaint) }}" onsubmit="return confirm('Hapus pengaduan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">Hapus Pengaduan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
