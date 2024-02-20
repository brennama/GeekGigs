<?php

namespace App\View\Components;

use App\Enums\RemotePolicy as RP;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RemotePolicy extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int|string|null $tabindex = null,
        public int|string $required = 0,
        public ?RP $selected = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.remote-policy');
    }
}
