<x-filament-panels::page>
    <x-filament-panels::form wire:submit.prevent="save">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">
            Save
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
