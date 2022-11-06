@props([
    'disabled' => false,
])

<div class="form-group">
    <label class="form-control-label">Email Address</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus {{ $disabled ? 'disabled' : '' }}
        {!! $attributes !!}>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
