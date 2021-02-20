<div class="container mx-auto">
    <x-toast-exito :flash="session('status')" :color="$color"></x-toast-exito>
    <x-loading-wire></x-loading-wire>
    <div class="w-full flex flex-wrap">
        <table class="table-auto shadow-xl">
            <thead>
                <tr wire:loading.class="text-purple-700">
                    <th class="tracking-widest text-xs font-bold">Nombre</th>
                    <th class="tracking-widest text-xs font-bold">Ranking</th>
                    <th class="tracking-widest text-xs font-bold">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($animes as $anime)
                    <tr class="rounded text-left bg-gray-900 text-white text-sm lowercase">
                        <td class="p-3">{{$anime->name}}</td>
                        <td class="p-3">{{$anime->puntaje}}</td>
                        <td class="p-3">
                            <a href="{{ route('editAnime', ['id'=>$anime->id]) }}">
                                <x-jet-button> Editar </x-jet-button>
                            </a>
                            <x-jet-danger-button wire:click="delete"> Eliminar </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pl-4 p-12">
            <form class="mb-12" wire:submit.prevent="store">
                <div>
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input wire:model="anime.name" class="w-64 p-4 border focus:outline-none"></x-jet-input>
                    <x-jet-input-error for="anime.name"></x-jet-input-error>
                </div>
                <div>
                    <x-jet-label>Puntaje</x-jet-label>
                    <x-jet-input wire:model="anime.puntaje" type="number" class="w-64 p-4 border focus:outline-none"></x-jet-input>
                    <x-jet-input-error for="anime.puntaje"></x-jet-input-error>
                </div>
                <div class="my-4">
                    <x-jet-button type="sumbit">Crear</x-jet-button>
                </div>
            </form>
            <div class="mt-4">
                {{ $animes->links() }}
            </div>
        </div>
    </div>
</div>
