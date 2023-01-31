@props([
    'active' => false,
    'name' => '',
    'link' => '#',
    'badge' => null,
    'badgeType' => 'primary',
    'icon' => 'far fa-circle',
])

<li class="nav-item">
    <a href="{{ $link }}" @class([
        'nav-link',
        'active' => $active
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
