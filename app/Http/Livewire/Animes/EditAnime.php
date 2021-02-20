<?php

namespace App\Http\Livewire\Animes;

use App\Models\anime;
use Livewire\Component;

class EditAnime extends Component
{

    public $color;
    public $anime;
    
    protected $rules = [
        'anime.name' => 'required',
        'anime.puntaje' => 'required|Numeric'
    ];


    public function mount($id)
    {
        $this->anime = anime::find($id);
    }

    public function render()
    {
        return view('livewire.animes.edit-anime');
    }

    public function update(){

        $this->validate();

        $colores = array("blue", "green", "purple", "red", "pink");
        $rand = array_rand($colores, 1);

        $this->color = $colores[$rand];

        $this->anime->update([
            'name' => $this->anime['name'],
            'puntaje' => $this->anime['puntaje']
        ]);
        

        session()->flash('status', 'Actualizado con exito');

    }
}
