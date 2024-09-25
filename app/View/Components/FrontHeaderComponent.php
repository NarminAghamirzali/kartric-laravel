<?php

namespace App\View\Components;

use App\Http\Controllers\Admin\LangController;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontHeaderComponent extends Component
{
    public function getLangs(){
        $langsFromLangs = app(LangController::class);
        $langs = $langsFromLangs->getLangs();
        return $langs;
    }
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
        $langs = $this->getLangs();
        $categories = Category::all();
        return view('components.front-header-component', compact('langs', 'categories'));
    }
}
