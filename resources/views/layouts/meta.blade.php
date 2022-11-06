<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $title ?? env('APP_NAME') }}" />
<meta property="og:site_name" content="{{ env('APP_NAME') }}" />
<meta property="og:url" content="{{ request()->url() }}" />
