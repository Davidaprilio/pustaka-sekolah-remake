<div class="card text-bg-dark img-banner">
    <img src="{{ $src }}" class="card-img w-100" alt="{{ $title }}">
    <div class="card-img-overlay d-flex align-content-between justify-content-between flex-column" title="{{ $title }}">
        <h5 class="card-title">{{ $title }}</h5>
        {{ $slot }}
    </div>
</div>