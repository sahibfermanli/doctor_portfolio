<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render(): View
    {
        return view('components.frontend.footer');
    }
}
