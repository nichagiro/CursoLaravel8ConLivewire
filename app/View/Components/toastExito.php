<?php

namespace App\View\Components;

use Illuminate\View\Component;

class toastExito extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $titulo; 
    public $color;

    public function __construct($flash, $color)
    {
        $this->titulo = $flash;
        $this->color = $color;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.toast-exito');
    }
}
