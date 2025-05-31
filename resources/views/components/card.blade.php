@props([
    'title',
    'value',
    'periode' => null,
    'delta' => null,
    'icon' => null,
    'bgColor' => '#f43f5e',
])

<div class="bg-white border border-gray-100 shadow-xs rounded-2xl p-4 w-full md:w-[calc(25%-1rem)]">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2 mr-4">
            <div 
                class="text-white rounded-md p-2 flex items-center justify-center" 
                style="background-color: {{ $bgColor }};"
            >
                @if ($icon)
                    {!! $icon !!}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                @endif
            </div>
            <h5 class="text-gray-800 font-semibold text-base leading-tight">
                {{ $title }}
            </h5>
        </div>

        <!-- Menu icon -->
        <div class="text-gray-400 cursor-pointer flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
            </svg>
        </div>
    </div>    

    <!-- Value & delta badge -->
    <div class="flex justify-between items-center mt-4">
        <p class="text-4xl font-semibold text-black">{{ $value }}</p>
        
        @if (!is_null($delta))
            <span class="text-sm font-medium rounded-md px-2 py-0.5 
                {{ $delta >= 0 ? 'bg-green-100 text-green-600 border border-green-500' : 'bg-red-100 text-red-600 border border-red-500' }}">
                {{ $delta >= 0 ? '+' : '' }}{{ number_format($delta, 0, ',', '.') }}
            </span>
        @endif
    </div>

    <!-- Periode -->
    @if ($periode)
        <p class="text-gray-400 text-sm mt-2">pada {{ $periode }}</p>
    @endif
</div>
