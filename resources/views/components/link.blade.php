@props([
    'method' => 'GET',
    'data' => [],
    'href' => '#',
    'slot' => '',
    'disabled' => false,
    'classform' => '',
    'btn' => false,
    'id' => false,
])
@php
$params = http_build_query($data);
$method = strtoupper($method);
$disabled = $disabled ? 'disabled' : '';
@endphp

@if ($method === 'GET')
    <a href="{{ $href }}" {{ $attributes }} {{ $disabled }}>{{ $slot }}</a>
@else
    <form action="{{ $href }}" class="d-inline btn-group {{ $classform }}" method="POST"
        id="{{ $id ? "form-{$id}" : '' }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
        <button type="{{ $btn ? 'button' : 'submit' }}" {{ $attributes }} {{ $disabled }}>{{ $slot }}</button>
    </form>
@endif
