<?php

namespace App\Http\Livewire;

use App\Models\hentai;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HentaiWire extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $photos = [];


    public function render()
    {
        $images = hentai::latest('id')->paginate(8);
        return view('livewire.hentai-wire', compact('images'));
    }

    public function save()
    {

        $this->validate([
            'photos.*' => 'image|max:1024', 
        ]);

        foreach ($this->photos as $photo) {
            
            $img = $photo->store('public/hentai');
            $url = Storage::url($img);

            hentai::create([
                'img' => $url
                ]);

            $this->reset();

        }
    }

    public function descarga($img){

        $url = str_replace('storage','public',$img['img']);
        return Storage::download($url);

    }

}
