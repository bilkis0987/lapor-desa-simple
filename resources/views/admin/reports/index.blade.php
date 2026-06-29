<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Pengaduan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Export Laporan PDF</h3>
                <form method="GET" action="{{ route('admin.reports.pdf') }}" class="space-y-4" target="_blank">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                                <option value="">Semua Status</option>
                                <option value="submitted">Baru</option>
                                <option value="verified">Diverifikasi</option>
                                <option value="in_progress">Diproses</option>
                                <option value="resolved">Selesai</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                            <input type="date" name="from_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                            <input type="date" name="to_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                            Export PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
