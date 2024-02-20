<?php

namespace App\View\Components;

use App\Enums\ExperienceLevel as Exp;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExperienceLevel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int|string|null $tabindex = null,
        public int|string $required = 0,
        public ?Exp $selected = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.experience-level');
    }
}
