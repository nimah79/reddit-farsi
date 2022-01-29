<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommunityDescriptionCard extends Component
{
    public $community;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($community)
    {
        $this->community = $community;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.community-description-card');
    }
}
