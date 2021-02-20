<div>
    <div class="mt-5">
        <x-loading-wire></x-loading-wire>
        <div class="pl-2">
            {{$images->links()}}
        </div>
        @error('photos.*') <span class="error">{{ $message }}</span> @enderror
        <div class="flex flex-wrap">
            <div class="w-2/3 flex flex-wrap">
                @foreach ($images as $img)    
                    <div class="h-64">
                        <div class="border ml-2 text-center" style="height: 200px; width: 200px;">
                            <img src="{{asset($img->img)}}" alt="laravel" style="width: 100%; height: 100%;">
                            <x-jet-danger-button wire:click="descarga({{$img}})" class="mt-2"> Descargar </x-jet-danger-button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border gray-200 w-1/3 p-4">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <x-jet-label class="italic text-sm"> Imagen </x-jet-label>
                        <x-jet-input type="file" wire:model="photos" multiple></x-jet-input>
                    </div>
                    <div class="mb-3">
                        <x-jet-button> Enviar</x-jet-button>
                    </div>
                </form>
                <div wire:loading wire:target="photos" class="text-green-800 font-bold">Vista previa...</div>
                @if ($photos)
                    <div class="flex flex-wrap">
                        @foreach ($photos as $photo)
                        <a href="{{ $photo->temporaryUrl() }}" target="_blank">
                            <div class="ml-2 mt-2" style="height: 100px; width: 100px">
                                <img src="{{ $photo->temporaryUrl() }}" style="width: 100%;height: 100%;">
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>    
</div>
