@props([
    'id' => null,
    'label' => null,
    'validation' => true,
    'type' => 'text',
    'value' => null,
    'default' => null,
    'name' => 'input',
    'col' => '',
])
@php
$id = $id ?? $name . '-input';
@endphp

<div class="form-group {{ $col }}">
    @if ($label)
        <label class="form-control-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <input
        {{ $attributes->class(['form-control', 'is-invalid' => $validation && $errors->has($name)])->merge([
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'value' => $value ?? (old($name, $value ?? null) ?? $default),
            'autocomplete' => $name,
        ]) }} />
    @if ($validation)
        @error($name)
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    @endif
</div>
