<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pengaduan #{{ $complaint->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $complaint->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="submitted" {{ $complaint->status == 'submitted' ? 'selected' : '' }}>Baru</option>
                            <option value="verified" {{ $complaint->status == 'verified' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                            <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Prioritas</label>
                        <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="low" {{ $complaint->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                            <option value="medium" {{ $complaint->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                            <option value="high" {{ $complaint->priority == 'high' ? 'selected' : '' }}>Tinggi</option>
                            <option value="urgent" {{ $complaint->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                        <textarea name="admin_note" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ old('admin_note', $complaint->admin_note) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
