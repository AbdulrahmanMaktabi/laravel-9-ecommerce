<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationMenu extends Component
{
    public $notifications, $countNoti;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->notifications = Auth::user()->notifications;
        $this->countNoti = Auth::user()->notifications()->count() ?? 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.notification-menu');
    }
}
