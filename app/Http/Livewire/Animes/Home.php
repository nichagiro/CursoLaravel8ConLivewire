<?php

namespace App\Http\Livewire\Animes;

use App\Models\anime;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    public $color;
    public $anime;

    use WithPagination;

        protected $rules = [
            'anime.name' => 'required|min:4|unique:animes,name',
            'anime.puntaje' => 'required|Numeric',
        ];

    public function mount(){
        $this->anime = new anime();
        $this->color = 'gray';
    }

    public function render()
    {
        $animes = anime::latest('id')->paginate(8);

        return view('livewire.animes.home', compact('animes'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store() {

        $this->validate();
        
        //guarda el mismo
        $this->anime->save();

        $this->reset(['color']);
        
        $this->color = 'blue';
        session()->flash('status', $this->anime['name'].' Creado con exito!.');

    }

}
