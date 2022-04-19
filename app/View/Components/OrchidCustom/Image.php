<?php

namespace App\View\Components\OrchidCustom;

use Illuminate\View\Component;

class Image extends Component
{
    public $url;
    public $alt;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $url=null, string $alt=null)
    {
        $this->url = $url;
        $this->alt = $alt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
            <div class='p-4'>
                <span class="form-label">Gambar</span>
                <img src="{{ $url }}"
                alt="{{ $alt }}"
                loading='lazy'
                height="300"
                width="300"
                class='mw-100 d-block img-fluid'>
            </div>
        blade;
    }
}