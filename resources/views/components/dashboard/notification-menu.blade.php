<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="bi bi-bell-fill"></i>
        <span class="navbar-badge badge text-bg-warning">{{ $countNoti }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <span class="dropdown-item dropdown-header">{{ $countNoti }} Notifications</span>
        @forelse ($notifications as $noti)
            <div class="dropdown-divider"></div>
            <a href="{{ $noti['url'] }}?notification_id={{ $noti->id }}" class="dropdown-item">
                <i class="{{ $noti->data['icon'] }}"></i> 4 new messages
                <span class="float-end text-secondary fs-7">{{ $noti->data['body'] }}</span>
                <span class="float-end text-secondary fs-7 mt-2">{{ $noti->created_at->diffForHumans() }}</span>
            </a>
        @empty
        @endforelse

    </div>
</li>
