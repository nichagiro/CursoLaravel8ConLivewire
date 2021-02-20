<div class="w-full uppercase font-semibold text-gray-400">
    <x-toast-exito :flash="session('status')" :color="$color_alert"></x-toast-exito>
    <x-loading-wire></x-loading-wire>
    <x-button-float></x-button-float>
    <h1 class="mb-2">Listado de personajes</h1>
    <div class="w-full flex flex-wrap">
        <div class="w-1/2">
            <table class="table-auto shadow-xl">
                <thead>
                    <tr wire:loading.class="text-purple-700">
                        <th class="tracking-widest text-xs font-bold">Personaje</th>
                        <th class="tracking-widest text-xs font-bold">Anime</th>
                        <th class="tracking-widest text-xs font-bold">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personajes as $personaje)
                    @if ($personaje->id == $personaje_id)
                    <tr class="rounded text-left text-white lowercase" style="background:black;">
                    @else
                    <tr class="rounded text-left text-white lowercase" style="background: {{$personaje->color}}">  
                    @endif
                        <td class="p-3">{{$personaje->name}}</td>
                        <td class="p-3">{{$personaje->name_anime}}</td>
                        <td class="p-3">
                            @if ($personaje->id == $personaje_id)
                            <p class="font-black text-white text-lg text-center italic">
                                EDITANDO
                            </p>
                            @else
                            <x-jet-button wire:click="show({{$personaje}})" class="bg-blue-700 hover:bg-blue-500 text-white">
                                Editar
                            </x-jet-button>    
                            <x-jet-danger-button onclick="modal({{$personaje}})">
                                Eliminar
                            </x-jet-danger-button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Gestion personajes --}}
        <div class="w-1/2">
            <div class="pl-2 w-full">
                <div class="w-full my-6">
                    <x-jet-label>Personaje</x-jet-label>
                    <x-jet-input wire:model.defer="name" wire:keydown.enter="store" class="shadow w-1/2 p-3"></x-jet-input>
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>
                <div class="w-full my-6">
                    <x-jet-label>Color</x-jet-label>
                    <x-jet-input wire:model.defer="color" type="color" class="shadow w-1/2 p-3"></x-jet-input>
                    <x-jet-input-error for="color"></x-jet-input-error>
                </div>
                <div class="w-full my-6">
                    <x-jet-label>Anime</x-jet-label>
                    <select wire:model.defer="anime_id" class="shadow w-1/2 p-3">
                        <option value="">Seleccione el anime</option>
                        @foreach ($animes as $anime)
                            <option value="{{$anime->id}}">{{$anime->name}}</option>
                        @endforeach
                    </select> 
                    <x-jet-input-error for="anime_id"></x-jet-input-error>
                </div>
                @if ($action == 'editar')
                    <div class="w-full my-6 flex -flex-wrap">
                        <div class="mx-2">
                            <x-jet-button wire:click="default" class="bg-green-700 hover:bg-green-400">
                                Cancelar
                            </x-jet-button>
                        </div>
                        <div class="mx-2">
                            <x-jet-button wire:click="update" class="bg-blue-700 hover:bg-blue-400">
                                Actualizar
                            </x-jet-button>     
                        </div>
                    </div>
                @else
                <div class="w-full mt-3 mb-16">
                    <x-jet-button wire:click="store">Crear</x-jet-button>
                </div>
                @endif
            </div>
            <div class="pl-2">
                {{$personajes->links()}}
            </div>
        </div>
    </div>
    <script>    
        function modal (personaje){
            Swal.fire({
                title: 'Desea eliminar este elemento',
                text: personaje.name + ' esta apunto de ser removido',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('destroy',personaje);
                    window.addEventListener('destroy-personaje', event => {
                        console.log(event);
                        if (event.detail.status) {
                            Swal.fire(
                                'Eliminado!',
                                personaje.name + ' esta removido'
                            )
                        }
                        else {
                            Swal.fire(
                                'Algo ocurrio!',
                                personaje.name + ' No fue eliminado'
                            )
                        }
                    });
                }
            })
        }
        function createAnime(){
            Swal.fire({
                html:
                    '<input id="name" placeholder="Nombre" class="w-full p-6 text-center bg-gray-200 border">'+
                    '<input id="puntaje" placeholder="Puntaje" type="Number" class="w-full mt-4 p-6 text-center bg-gray-200 border">',
                title: 'Crear Anime.',
                width: 600,
                height: 600,
                showConfirmButton: true,
                confirmButtonText: 'Crear',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                padding: '3em',
                background: 'rgba(0,0,123,0.4)',
                backdrop: `
                    rgba(0,0,123,0.4)
                    url("http://127.0.0.1:8000/img/anime.jpg")
                    center
                    no-repeat
                `
            })
            .then((result) => {
                const name = document.getElementById('name').value; 
                const puntaje = document.getElementById('puntaje').value; 
                const anime = {"name":name, "puntaje":puntaje};
                if (result.isConfirmed) {
                    if(anime.value != ''){
                        livewire.emit('animeStore', anime);
                        window.addEventListener('crear-anime', event => {
                            if (event.detail.status) {
                                Swal.fire(
                                    'Creado!',
                                    this.name  + ' ingresado con exito',
                                    'success'
                                )
                            } 
                            else {
                                Swal.fire(
                                    'Algo salio mal!',
                                    'Verifica que ya exista ese anime',
                                    'error'
                                )
                            }
                        });
                    } 
                    else {
                        Swal.fire(
                        'Campo vacio!',
                        'No dejes el campo vacio',
                        'error'
                        )
                    }
                }
            })
        }   
    </script>
</div>
