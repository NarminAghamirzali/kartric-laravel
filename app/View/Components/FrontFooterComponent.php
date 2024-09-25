<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Service;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontFooterComponent extends Component
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
        $categories = Category::all();
        $services = Service::all();
        $contacts = Contact::all();
        return view('components.front-footer-component', compact('categories', 'services', 'contacts'));
    }
}
