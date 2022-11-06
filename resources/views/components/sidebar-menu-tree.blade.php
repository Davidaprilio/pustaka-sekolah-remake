@props([
    'name' => '',
    'feather' => false,
    'icon' => false
])
<li class="submenu">
  <a href="#">
    @if ($icon || $feather)
    <i class="{{ $icon }}" @if ($feather) data-feather="{{ $feather }}" @endif></i> 
    @endif
    <span>{{ $name }}</span> 
    <span class="menu-arrow"></span>
  </a>
  <ul>									
    {{ $slot }}
  </ul>
</li>