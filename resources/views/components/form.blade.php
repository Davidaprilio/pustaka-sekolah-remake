@props([
    'method' => 'GET',
    'action' => '#',
    'url' => null,
    'route' => null
])
@php
$method = strtoupper($method);
if ($url) {
    $action = url($url);
} else if ($route) {
    if (is_string()) {
        $route = [$route, []];
    }
    $action = route($route[0], $route[1]);
}
@endphp

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    @if ($method !== 'POST' && $method !== 'GET')
        @method($method)
    @endif
    {{ $slot }}
</form>
