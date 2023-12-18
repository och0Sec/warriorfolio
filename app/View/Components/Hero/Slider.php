<?php

namespace App\View\Components\Hero;

use App\Models\Slideshow;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero.slider', [
            'slides' => Slideshow::query()
                ->select(['content', 'title'])
                ->where('module_name', '=', 'hero-section')
                ->where('is_active', '=', true)
                ->get()
        ]);
    }
}