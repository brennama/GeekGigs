<?php

namespace App\View\Components;

use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Save extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Job $job, public bool $saved)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.save');
    }
}
