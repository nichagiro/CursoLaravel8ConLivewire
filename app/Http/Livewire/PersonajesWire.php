<?php

namespace App\Http\Livewire;

use App\Models\anime;
use App\Models\personaje;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;


class PersonajesWire extends Component
{

    protected $listeners = ['destroy','animeStore'];

    use WithPagination;

    public $name, $color, $anime_id, $personaje_id;
    public $action = 'crear';
    public $color_alert; 
    public $anime;

    protected $rules = [
        'name' => 'required|min:4',
        'color' => 'required',
        'anime_id' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Campo vacio',
        'name.min' => 'minimo cuatro letras',
        'color.required' => 'Color requerido',
        'anime_id.required' => 'Anime requerido',
    ];

    protected $validationAttributes = [
        'anime_id' => 'Anime'
    ];

    
    public function render()
    {
        $personajes = personaje::join('animes', 'animes.id', '=', 'personajes.anime_id')
        ->select('animes.id as id_anime', 'animes.name as name_anime','personajes.id',
        'personajes.name', 'personajes.color')
        ->latest('id')
        ->paginate(8);
        
        $animes = anime::latest('id')->get();

        return view('livewire.personajes-wire', compact('personajes','animes'));
    }


    public function show($personaje){

        $this->name = $personaje['name'];
        $this->color = $personaje['color'];
        $this->anime_id = $personaje['id_anime'];
        $this->personaje_id = $personaje['id'];

        $this->action = 'editar';

    }

    public function animeStore($anime){

        try {

            anime::create([
            'name' => $anime['name'],
            'puntaje' => $anime['puntaje']
            ]);

            $this->dispatchBrowserEvent('crear-anime', ['status' => true]);      

            } 
       
        catch (\Throwable $th) {
            
            $this->dispatchBrowserEvent('crear-anime', ['status' => false]);      
       
            }

    }


    public function default(){

        $this->reset();
     
    }

    public function update(){   

       $personaje = personaje::find($this->personaje_id);

       $personaje->update([
           'name' => $this->name,
           'anime_id' => $this->anime_id,
           'color' => $this->color
       ]);

       $this->reset();
       $this->color_alert ="blue";
       session()->flash('status', 'Editado con exito!.');


    }

    public function destroy($personaje){   
        
        try {
            personaje::destroy($personaje);    

            $this->reset();
            $this->color_alert ="red";
            $this->dispatchBrowserEvent('destroy-personaje', ['status' => true]);
                        
        }
        catch (\Throwable $th) {
            $this->dispatchBrowserEvent('destroy-personaje', ['status' => false]);
        }
        
        
     }


    public function store(){
                
        $this->validate();
        // $this->validate([
        //     'name' => 'required|max:2'
        // ]);

        personaje::create([
            'name' => $this->name,
            'anime_id' => $this->anime_id,
            'color' => $this->color 
        ]);
        
        $this->reset();
        $this->color_alert ="green";
        session()->flash('status', 'Guardado con exito!.');
        

    }


}

