<?php

use App\Http\Livewire\Animes\EditAnime;
use App\Http\Livewire\Animes\Home;
use App\Http\Livewire\Gatos\EditCatWire;
use App\Http\Livewire\GatosWire;
use App\Http\Livewire\HentaiWire;
use App\Http\Livewire\PersonajesWire;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return view('welcome');
});


Route::get('animes', Home::class)->name('animes');
Route::get('gatos-mierda', GatosWire::class)->name('cat');
Route::get('editar-gato/{id}', EditCatWire::class)->name('edit-cat');

Route::get('editAnime/{id}', EditAnime::class)->name('editAnime');
Route::get('personajes', PersonajesWire::class )->name('personajes');

Route::get('hentai', HentaiWire::class)->name('hentai');
