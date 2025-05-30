<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if (session('force_fill_email'))
                        <div class="mb-4 text-sm text-red-600">
                            Silakan lengkapi alamat email Anda sebelum melanjutkan.
                        </div>
                    @endif
                    <livewire:admin.profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @if (auth()->user()->is_default_password)
                    <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
                        Anda masih menggunakan password default. Harap ganti password dan lengkapi email Anda.
                    </div>
                @endif
                <div class="max-w-xl">
                    <livewire:admin.profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:admin.profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
