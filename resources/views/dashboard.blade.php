<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            {{ __('> Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            <div>
                <div class="font-bold text-3xl text-gray-900">
                    {{ __("Statistik") }}
                </div>
            </div>
        </div>

        <div class="mx-auto sm:px-4 lg:px-6">
            <div>
                <div class="font-bold text-3xl text-gray-900">
                    {{ __("Chart") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
