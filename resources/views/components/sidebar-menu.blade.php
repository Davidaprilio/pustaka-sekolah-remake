@props([
    'active' => false,
    'name' => '',
    'link' => '#',
    'icon' => false,
])

<li @class(['active' => $active])>
    <a class="nav-link" href="{{ $link }}">
        @if ($icon || $feather)
            <div class="sb-nav-link-icon">
                <i class="{{ $icon }}"></i>
            </div>
        @endif
        <span>{{ $name }}</span>
    </a>
</li>
