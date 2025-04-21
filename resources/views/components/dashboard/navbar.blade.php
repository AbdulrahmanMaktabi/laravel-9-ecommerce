<nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
            {{-- <li class="nav-header">{{ $item['title'] }}</li> --}}
            @if (isset($item['childrens']))
                <li @class([
                    'nav-item',
                    'menu-open' => collect($item['childrens'])->pluck('route')->contains(Route::currentRouteName()),
                ])>
                    <a href="#" class="nav-link ">
                        <i class="nav-icon {{ $item['icon'] }}"></i>
                        <p>
                            {{ $item['title'] }}
                            <i @class([
                                'nav-arrow bi bi-chevron-right' => isset($item['childrens']),
                            ])></i>
                            <p>{{ isset($item['childrens']) }}</p>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($item['childrens'] as $child)
                            <li class="nav-item">
                                <a href="{{ route($child['route']) }}" @class([
                                    'nav-link',
                                    'active' => Route::currentRouteNamed($child['route']),
                                ])>
                                    <i class="nav-icon {{ $child['icon'] }}"></i>
                                    <p>{{ $child['title'] }}</p>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>
            @else
                <li class="nav-item">
                    {{-- @dump([$item['route'], Route::currentRouteName()]) --}}
                    <a href="{{ route($item['route']) }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteNamed($item['route']),
                    ])>
                        <i class="nav-icon {{ $item['icon'] }}"></i>
                        <p>
                            {{ $item['title'] }}
                            <i @class([
                                'nav-arrow bi bi-chevron-right' => isset($item['childrens']),
                            ])></i>
                            <p>{{ isset($item['childrens']) }}</p>
                        </p>
                    </a>
                </li>
            @endif
        @endforeach


    </ul>
    <!--end::Sidebar Menu-->
</nav>
