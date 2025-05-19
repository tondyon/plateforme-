<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavDropdown extends Component
{
    public $title;
    public $active;

    public function __construct($title, $active = false)
    {
        $this->title = $title;
        $this->active = $active;
    }

    public function render()
    {
        return view('components.nav-dropdown');
    }
}
