@props([
    'type' => 'primary',
    'dismiss' => true,
    'name' => null,
    'id' => false,
])

@php $nameSession = $name ?? $type; @endphp

@if (session()->has($nameSession))
    <x-alert.basic :type="$type" :dismiss="$dismiss" :message="session()->get($nameSession)" :id="$id" />
@endif
