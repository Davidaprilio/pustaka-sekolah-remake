<x-alert.error name="*" />

@foreach ([
    'primary',
    'secondary',
    'success',
    'danger',
    'error',
    'warning',
    'info',
    'light',
    'dark'
] as $flash)
    <x-alert.flash :name="$flash" :type="$flash" />
@endforeach