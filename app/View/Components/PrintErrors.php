<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PrintErrors extends Component
{

    public $action;
    public $field;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $field)
    {
        $this->action = $action;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.print-errors');
    }
}
