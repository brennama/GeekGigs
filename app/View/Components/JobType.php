<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobType extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int|string|null $tabindex = null, public int|string $required = 0)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-type');
    }
}
