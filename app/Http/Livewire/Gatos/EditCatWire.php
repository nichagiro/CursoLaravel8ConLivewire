<?php

namespace App\Http\Livewire\Gatos;

use App\Models\cat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCatWire extends Component
{
    use WithFileUploads;
    public $cat;
    public $photo;
    public $color='red';
    public $num = 0;

    protected $rules = [
        'cat.slug' =>'required',
    ];

    public function mount($id)
    {
        $this->cat = cat::find($id);
    }

    public function render()
    {
        return view('livewire.gatos.edit-cat-wire');
    }


    public function sumar($numero){

        $this->num += $numero; 

    }

    public function update(){

        $this->validate();
        
        if ($this->photo == null) {
           
            $this->cat->update([
                'slug' => $this->cat['slug']
            ]);

        }
        else{
            
            // save new img
           $img = $this->photo->store('public/gatos');
           $url = Storage::url($img);

            // old img
            $file = $this->cat['img'];
            $path = str_replace('storage','public', $file);


           $this->cat->update([
                'slug' => $this->cat['slug'],
                'img' => $url
            ]);

            //delete img old
            Storage::delete($path);
            
            //remove miniature img
            $this->reset(['photo']);
        }
                
    }

    public function color(){

        $colores = ['green','red','blue','yellow','indigo','pink'];
        $ran = array_rand($colores,1);

        $this->color = $colores[$ran];       

    }

}
