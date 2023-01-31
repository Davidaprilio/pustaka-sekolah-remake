@props([
    'name' => '',
    'icon' => 'fas fa-tachometer-alt',
    'active' => false
])
<li class="nav-item menu-open">
    <a href="#" @class([
        'nav-link',
        'active' => $active
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