{{-- @if ($getState() && is_array($getState()))
    @foreach ($getState() as $file)
        @php
            $url = Storage::url($file); // ensures public URL
            $name = basename($file);
        @endphp
        <a href="{{ $url }}" target="_blank" class="text-primary underline">
            {{ $name }}
        </a><br>
    @endforeach
@else
    <span class="text-gray-500">-</span>
@endif --}}
@php
    $files = $getState(); // documents field value (array)
@endphp

<div class="flex flex-wrap gap-2">
    @if ($files && is_array($files))
        @foreach ($files as $file)
            <div class="flex items-center gap-1 px-2 py-1 bg-gray-100 rounded-lg text-sm">
                <span class="truncate max-w-[120px]" title="{{ $file }}">
                    {{ \Illuminate\Support\Str::limit(basename($file), 15) }}
                </span>
                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                    <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                </a>
            </div>
        @endforeach
    @else
        <span class="text-gray-400 italic">No files</span>
    @endif
</div>
