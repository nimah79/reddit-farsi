<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostSortTypes extends Component
{
    public $sortType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sortType)
    {
        $this->sortType = $sortType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-sort-types');
    }
}
