<div class="px-6" wire:poll="color">
    <div class="flex flex-wrap bg-{{$color}}-700 justify-center p-2">
        <div class="bg-gray-100 border shadow-xl p-8">
            Tiempo: {{ now() }}
            <div class="mb-4 mt-2">
                <x-jet-label class="italic">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="cat.slug" class="p-4 focus:outline-none"></x-jet-input>
                <x-jet-input-error for="cat.slug"></x-jet-input-error>
            </div>
            <div class="mb-8">
                <x-jet-label class="italic">Imagen</x-jet-label>
                <x-jet-input wire:model.defer="photo" type="file"></x-jet-input>
                <x-jet-input-error for="photo"></x-jet-input-error>
            </div>
                <x-jet-danger-button wire:loading.attr="disabled" wire:click="update">Actualizar</x-jet-danger-button>
            @if ($photo)
                <div class="mt-2 w-32 h-32">
                    <img src="{{ $photo->temporaryUrl() }}" alt="laravel 8">
                </div>
            @endif
        </div>
        <div class="shadow-2xl" style="height: 460px;">
            <img src="{{asset($cat['img'])}}" alt="laravel" style="height: 100%;">
        </div>
    </div>
    <div wire:loading wire:target="update">
        <x-loading-wire></x-loading-wire>
    </div>
</div>
