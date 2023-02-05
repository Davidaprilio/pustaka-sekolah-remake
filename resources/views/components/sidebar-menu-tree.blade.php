@props([
    'name' => '',
    'icon' => 'fas fa-tachometer-alt',
])

@php
    $isOpen = strpos($slot->toHtml(), 'class="nav-link active"') !== false
@endphp

<li @class([
    'nav-item',
    'menu-open' => $isOpen
])>
    <a href="#" @class([
        'nav-link',
        'active' => $isOpen
    ])>
        <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $name }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
      {{ $slot }}
    </ul>
</li>