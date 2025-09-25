@if ($getState() && is_array($getState()))
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
@endif
