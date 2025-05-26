<?php

namespace App\View\Components\Dashboard\Role;

use App\Models\Role;
use Illuminate\View\Component;

class RoleForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public ?Role $role;
    public $method;
    public $route;
    public $button;
    public $abilites = null;

    public function __construct($role = null, $abilites = null, $method = '', $route, $button = 'Create')
    {
        $this->role = $role ?? new Role();
        $this->method = $method;
        $this->route = $route;
        $this->button = $button;
        $this->abilites = $abilites;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.role.role-form');
    }
}
