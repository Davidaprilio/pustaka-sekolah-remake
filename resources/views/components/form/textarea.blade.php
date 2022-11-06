@props([
    'id' => null,
    'label' => null,
    'validation' => true,
    'default' => null,
    'name' => 'textarea',
    'col' => ''
])
@php
    $id = $id ?? $name . "-textarea";
@endphp

<div class="form-group {{ $col }}">
    @if ($label)
    <label class="form-control-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <textarea {{ $attributes->class(['form-control', 'is-invalid' => $validation && $errors->has($name)])->merge([
        'id' => $id,
        'name' => $name,
    ]) }}>{!! old($name, $value ?? null) ?? $default !!}</textarea>
    @if ($validation)
        @error($name)
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    @endif
</div>