<div>
    <x-loading-wire></x-loading-wire>
    <x-toast-exito :flash="session('status')" :color="$color"></x-toast-exito>
    <div class="border  shadow 2xl bg-gray-200 p-6 mb-4">
        <x-jet-label>Nombre:</x-jet-label>
        <b class="text-italic">{{$anime->name}}</b>
        <x-jet-label>Ranking:</x-jet-label>
        <b>{{$anime->puntaje}}</b>
    </div>
    <div class="pl-6 w-full flex flex-wrap">
        <form wire:submit.prevent="update">
            <x-jet-label>Nombre:</x-jet-label>
            <x-jet-input wire:model.defer="anime.name" class="p-4 border focus:outline-none"></x-jet-input>
            <x-jet-label>Ranking:</x-jet-label>
            <x-jet-input wire:model.defer="anime.puntaje" name="puntaje" class="p-4 border focus:outline-none"></x-jet-input>
            <div class="mt-4">
                <x-jet-danger-button type="submit">Enviar</x-jet-danger-button>
            </div>
        </form>
        <div class="p-16">
            <x-jet-validation-errors></x-jet-validation-errors>
        </div>
    </div>
</div>
