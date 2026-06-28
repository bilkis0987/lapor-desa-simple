<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Selamat datang di panel admin LaporDesa.</p>
                    <a href="{{ route('admin.dashboard') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                        &rarr; Buka Dashboard Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
