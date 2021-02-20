<?php

namespace App\Http\Livewire;

use App\Models\cat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;



class GatosWire extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $photo;
    public $name;
    protected $listeners = ['destroy'];

    public function render()
    {
        $cats = cat::latest('id')->paginate(8);
        return view('livewire.gatos-wire', compact('cats'));
    }
    
    public function redireccion($id){

        redirect()->route('edit-cat', $id);

    }

    public function store(){
            
            $file = $this->photo->store('public/gatos');
            $url = Storage::url($file);          

            try{

                cat::create([
                    'slug' => $this->name,
                    'img' =>  $url
                ]);

                $this->reset();

            }

            catch(\Throwable $th){


            }
        
    }

    public function destroy($data){ 

        try {
            
            cat::destroy($data);
            $this->dispatchBrowserEvent('destroy', ['status' => true]);  

            $url = str_replace('storage','public', $data['img']);
            Storage::delete($url);

        }

        catch (\Throwable $th) {

            $this->dispatchBrowserEvent('destroy', ['status' => false]);      

        }

    }

    public function descarga($img){
    
        $url = str_replace('storage','public', $img['img']);
        $slug = $img['slug'];

        return Storage::download($url, $slug. '.png');

    }

}
