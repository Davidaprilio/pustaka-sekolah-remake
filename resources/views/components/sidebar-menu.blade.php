@props([
    'name' => '',
    'route' => 'dashboard',
    'badge' => null,
    'badgeType' => 'primary',
    'icon' => 'far fa-circle',
])

@aware([
    'activeMenu' => false
])

<?php 
    if (gettype($route) == 'string') $route = [$route, []];
?>

<li class="nav-item">
    <a href="{{ route($route[0], $route[1] ?? []) }}" @class([
        'nav-link',
        'active' => $activeMenu ? ($activeMenu == $route[0]) : request()->routeIs("{$route[0]}*")
    ])>
        <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $slot->isEmpty() ? $name : $slot }}
            @if ($badge)
            <span class="right badge badge-{{ $badgeType }}">{{ $badge }}</span>
            @endif
        </p>
    </a>
</li>
