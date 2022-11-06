@props([
    'id' => null,
    'label' => null,
    'validation' => true,
    'type' => 'text',
    'default' => null,
    'name' => 'input',
    'col' => '',
])
@php
$id = $id ?? $name . '-select';
$value = old($name, $value ?? null) ?? $default;
@endphp

<div class="form-group {{ $col }}">
    @if ($label)
        <label class="form-control-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <select
        {{ $attributes->class(['form-select', 'is-invalid' => $validation && $errors->has($name)])->merge([
            'id' => $id,
            'name' => $name,
        ]) }}>
        {{ $slot }}
    </select>
    @if ($validation)
        @error($name)
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    @endif
</div>
