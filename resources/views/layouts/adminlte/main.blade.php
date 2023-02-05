{{-- 
    Config Layout AdminLTE
    title       : megatur judul pada tab halaman
    titlePage   : menambahkan nama halaman pada judul tab halaman 
    activeRoute : overwrite nama route yang aktif pada halaman
    pageName    : memberikan nama halaman pada header content
    breadcrumb  : membuatkan breadcrumb pada header content dengan format strign/array
                    string = 'Panel/Path/To/Page'
                    array = [
                        'Panel',
                        'Path' => null,
                        'To' => url('url/to/page')
                    ]
 --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ isset($titlePage) ? "{$titlePage} | " : '' }}
        {{ $title ?? config('app.name') }}
    </title>
    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <style>
        .logo-mobile {
            display: none;
        }

        @media (max-width: 991.98px) {
            .logo-mobile {
                display: block;
            }
        }

        .btn-xs {
            --bs-btn-padding-y: .18rem;
            --bs-btn-padding-x: .5rem;
            --bs-btn-font-size: 12px;
        }
    </style>

    <script>
        function csrf_token() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function url(path) {
            if (!path.startsWith('/')) {
                path = '/' + path;
            }
            return "{{ url('/') }}" + path;
        }

        function ajaxPromise(url, method = 'GET', data, options = {}) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    ...options,
                    success: function(response) {
                        resolve(response);
                    },
                    error: function(error) {
                        reject(error);
                    }
                });
            });
        }

        async function submitForm(idForm) {
            let form
            if (typeof idForm === 'string') {
                form = document.querySelector(idForm);
                if (!form) {
                    throw new Error(`Form ${idForm} tidak ditemukan`);
                }
            } else {
                // check is jquery object
                form = (idForm instanceof jQuery) ? idForm[0] : idForm;
                if (form.tagName !== 'FORM') {
                    throw new Error('Element bukan form');
                }
            }
            const formData = new FormData(form);
            const url = form.getAttribute('action');
            const method = form.getAttribute('method');
            const options = {
                processData: false,
                contentType: false,
            };
            return await ajaxPromise(url, method, formData, options);
        }

        function bsAlert(content, color = 'success', dissmissable = true) {
            const alert = document.createElement('div');
            alert.classList.add('alert', `alert-${color}`);
            if (dissmissable) {
                alert.classList.add('alert-dismissible', 'fade', 'show');
                alert.setAttribute('role', 'alert');
                alert.innerHTML = `
                    ${content}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
            } else {
                alert.innerHTML = content;
            }
            return alert;
        }

        function makeAlertFromError(err) {
            let alertHTML
            if (err.status == 500) {
                alertHTML = bsAlert('Terjadi kesalahan pada server', 'danger');
            } else if (err.status == 422) {
                alertHTML = bsAlert(err.responseJSON.message, 'warning');
            } else {
                return false
            }
            return alertHTML;
        }
    </script>
    @stack('head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.adminlte.navbar')

        {{-- left Sidebar --}}
        @include('layouts.adminlte.sidebar', [
            'activeRoute' => $activeRoute ?? false
        ])

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <div class="content-header">
                <div class="container-fluid">
                    @if (isset($breadcrumb) || isset($pageName))
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $pageName }}</h1>
                            </div>{{-- /.col --}}
                            <div class="col-sm-6">
                                @isset($breadcrumb)
                                    @php
                                        if (gettype($breadcrumb) === 'string') {
                                            $breadcrumb = explode('/', $breadcrumb);
                                        }
                                    @endphp
                                    <ol class="breadcrumb float-sm-right">
                                        @foreach ($breadcrumb as $text => $link)
                                            @php
                                                if (gettype($text) != 'string') {
                                                    $text = $link;
                                                    $link = null;
                                                }
                                            @endphp
                                            @if ($loop->last)
                                                <li class="breadcrumb-item active">{{ $text }}</li>
                                            @else
                                                <li class="breadcrumb-item">
                                                    <a href="{{ $link ?? '#' }}">{{ $text }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                @endisset
                            </div>{{-- /.col --}}
                        </div>{{-- /.row --}}
                    @endif
                </div>{{-- /.container-fluid --}}
            </div>
            {{-- /.content-header --}}
            
            {{-- Main content --}}
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        {{-- Control/Right Sidebar --}}
        <aside class="control-sidebar control-sidebar-dark">
            {{-- Control sidebar content goes here --}}
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        {{-- /.control-sidebar --}}

        {{-- Main Footer --}}
        <footer class="main-footer text-sm py-2">
            {{-- To the right --}}
            <div class="float-right d-none d-sm-inline">
                SuportBy DavidArl
            </div>
            {{-- Default to the left --}}
            <strong>Copyright &copy; 2022 - {{ date('Y') }} PUSTAKA</a>.</strong>
            All rights reserved.
        </footer>
    </div>

    {{-- jQuery --}}
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
