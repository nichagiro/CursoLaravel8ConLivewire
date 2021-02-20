<div class="mt-5">
    <x-loading-wire></x-loading-wire>
    <div class="pl-2">
        {{$cats->links()}}
    </div>
    <div class="flex flex-wrap">
        <div class="w-2/3 flex flex-wrap">
            @foreach ($cats as $cat)    
                <div class="border bg-gray-200 ml-2 mb-2 text-center mb-16" style="height: 200px; width: 200px;">
                    <img src="{{asset($cat->img)}}" alt="laravel" style="width: 100%; height: 100%;">
                    <div class="mt-2 flex flex-wrap justify-around">
                        <x-jet-button wire:click="redireccion({{$cat->id}})">Edit</x-jet-button>
                        <x-jet-danger-button onclick="modalDelete({{$cat}})">Delete</x-jet-danger-button>
                        <x-jet-button wire:click="descarga({{$cat}})" class="bg-green-800 text-white text-md font-black">↓</x-jet-button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="border gray-200 w-1/3 p-4">
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <x-jet-label class="italic text-sm"> Imagen </x-jet-label>
                    <x-jet-input type="file" wire:model="photo"></x-jet-input>
                </div>
                <div class="mb-3">
                    <x-jet-label class="italic text-sm"> Nombre </x-jet-label>
                    <x-jet-input class="p-2 border focus:outline-none" wire:model.defer="name"></x-jet-input>
                </div>
                <div class="mb-3">
                    <x-jet-button> Enviar</x-jet-button>
                </div>
            </form>
            <div wire:loading wire:target="photo" class="text-green-800 font-bold">CARGANDO FOTO...</div>
            @if ($photo)
                <small class="italic text-green-800 font-bold">Vista Previa:</small>
                <img src="{{ $photo->temporaryUrl() }}" height="200px" width="200px">
            @endif
        </div>
    </div>
    <script>
        function modalDelete(cat){
            Swal.fire({
                title: 'Seguro que quieres eliminar a',
                text: cat.slug ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('destroy', cat);
                    window.addEventListener('destroy', event => {
                        if (event.detail.status) {
                            Swal.fire(
                            'Exito!',
                            cat.slug + ' Eliminado correctamente',
                            'success'
                            )
                        }   
                        else {
                            Swal.fire(
                            'Error!',
                            cat.slug + ' No se elimino',
                            'error'
                            )
                        }
                    });
                }
            })
        }
    </script>
</div>
