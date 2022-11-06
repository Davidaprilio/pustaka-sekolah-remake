@props([
    'method' => 'GET',
    'action' => '#',
])
@php
$method = strtoupper($method);
@endphp

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    @if ($method !== 'POST' && $method !== 'GET')
        @method($method)
    @endif
    {{ $slot }}
</form>
