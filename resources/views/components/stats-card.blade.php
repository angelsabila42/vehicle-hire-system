@props(['title', 'value', 'trend' => null, 'icon', 'color'])

@php
    // These colors match the soft pastel backgrounds in your Figma design
    $iconColors = [
        'blue'   => 'bg-blue-50 text-blue-600',
        'green'  => 'bg-green-50 text-green-600',
        'yellow' => 'bg-yellow-50 text-yellow-600',
        'purple' => 'bg-purple-50 text-purple-600',
        'red'    => 'bg-red-50 text-red-600',
    ];
@endphp

<div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
    <div class="flex flex-col h-full justify-between">
        <div class="p-3 w-fit rounded-2xl {{ $iconColors[$color] ?? 'bg-gray-50 text-gray-600' }} mb-6">
            <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
        </div>
        
        <div>
            <h3 class="text-4xl font-bold text-slate-900 mb-1">{{ $value }}</h3>
            <p class="text-gray-500 font-medium">{{ $title }}</p>
        </div>

        @if($trend)
            <div class="mt-4 pt-4 border-t border-gray-50">
                <span class="text-sm font-medium {{ str_contains($trend, '+') || str_contains($trend, 'Ready') ? 'text-green-600' : 'text-gray-400' }}">
                    {{ $trend }}
                </span>
            </div>
        @endif
    </div>
</div>