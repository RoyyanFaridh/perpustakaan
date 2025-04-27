<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-md">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="store" class="space-y-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input wire:model.defer="nama" type="text" id="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                <input wire:model.defer="nomor_induk" type="text" id="nomor_induk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('nomor_induk') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input wire:model.defer="alamat" type="text" id="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('alamat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas / Jurusan</label>
                <input wire:model.defer="kelas" type="text" id="kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('kelas') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                <input wire:model.defer="telepon" type="text" id="telepon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('telepon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model.defer="email" type="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('anggota.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">← Kembali ke Daftar Anggota</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
