<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Profil Pengguna</h2>

    {{-- Notifikasi Email Belum Diisi --}}
    @if (session('force_fill_email'))
        <div class="p-4 mb-4 rounded-md bg-red-50 border border-red-300 text-red-800 text-sm">
            Silakan lengkapi alamat email Anda sebelum melanjutkan.
        </div>
    @endif

    {{-- Grid 2 Kolom --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Informasi Profil --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Profil</h3>
            <p class="text-sm text-gray-600 mb-4 flex items-center gap-2">
                Perbarui nama dan email Anda agar informasi akun tetap akurat.
            </p>
            <livewire:admin.profile.update-profile-information-form />
        </div>

        {{-- Ubah Password --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Keamanan</h3>
            <p class="text-sm text-gray-600 mb-4 flex items-center gap-2">
                Gunakan password yang kuat dan rutin diperbarui untuk menjaga keamanan akun.
            </p>
            <livewire:admin.profile.update-password-form />
        </div>
    </div>

{{-- Ubah Password --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Keamanan</h3>
            <p class="text-sm text-gray-600 mb-4 flex items-center gap-2">
                Gunakan password yang kuat dan rutin diperbarui untuk menjaga keamanan akun.
            </p>
            <livewire:admin.profile.delete-user-form />
        </div>
</div>
