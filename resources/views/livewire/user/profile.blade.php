<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi password default --}}
            @if (auth()->user()->is_default_password)
                <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded shadow">
                    <strong>Perhatian:</strong> Anda masih menggunakan password default. Silakan ganti password dan lengkapi email Anda.
                </div>
            @endif

            @if(session('force_fill_email'))
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
                    Silakan lengkapi email Anda terlebih dahulu untuk melanjutkan.
                </div>
            @endif

            {{-- Form Update Email dan Password (digabung dalam 1 komponen) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:user.profile />
                </div>
            </div>

            <div class="mb-4">
                @if (auth()->user()->hasVerifiedEmail())
                    <div class="text-green-700 font-semibold">
                        Email sudah terverifikasi.
                    </div>
                @else
                    <div class="text-red-700">
                        Email belum terverifikasi. Silakan cek email Anda untuk verifikasi.
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-user-layout>
