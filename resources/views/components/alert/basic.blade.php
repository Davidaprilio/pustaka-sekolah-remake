@props([
    'id' => false,
    'type' => 'primary',
    'dismiss' => true,
    'message' => '',
])

<div {{ $attributes->class([
    "alert alert-{$type}", 
    'alert-dismissible fade show' => $dismiss,
    "alert-{$id}" => $id
]) }} role="alert">
    {{ $message }}
    {{ $slot }}
    @if ($dismiss)
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>        
    @endif
</div>
