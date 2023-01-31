<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Guru | Perpustakaan Elektronik</title>
    {{-- <link rel="stylesheet" href="{{ url('/bootstrap/css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/admin/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ url('/fonts/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="{{ url('/js/jquery-3.5.1.min.js') }}"></script>
    <style>
        .btn-xs {
            --bs-btn-padding-y: .18rem;
            --bs-btn-padding-x: .5rem;
            --bs-btn-font-size: 12px;
        }
        .dataTables_wrapper .row:first-child {
            padding: .25rem !important;
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
</head>
<body class="sb-nav-fixed {{ $tema ?? 'dark' }} bg-light">
    <nav class="navbar navbar-expand shadow-sm sticky-top sb-topnav py-0 border-bottom border-warning">
        <div class="container-fluid">
            <button class="btn btn-link btn-sm ms-2 text-light order-1 order-md-2" id="sidebarToggle" type="button">
                <i class="fa fa-bars"></i>
            </button>
            <a href="<?= url('/Pustaka'); ?>" class="order-3">
            <button class="btn btn-link btn-sm text-light d-none d-sm-inline-block" type="button">
                <i class="fa fa-home"></i>
            </button></a>
            <a class="navbar-brand d-flex order-2 order-md-1" href="/Administrator">
                <img src="/img/logo/pustakaM.png">
                <div class="brand-txt">
                    <h4 class="mb-0">Pustaka</h4>
                    <small class="d-block">Panel Guru</small>
                </div>
            </a>
            <span class="ms-auto order-4">
            </span>

            <ul class="nav navbar-nav text-end d-flex order-5 ms-auto ms-md-0">
                <li class="nav-item float-end justify-content-end align-items-center border-0" role="presentation">
                    <div class="nav-item dropdown no-arrow">
                        <a class="dropdown-toggle active text-white" data-bs-toggle="dropdown" href="javascript:void(0)">
                            <img class="rounded-circle" src="<?= url('/img/boy.jpg'); ?>">
                            <!-- $dataAdmin['fotoprofile'] -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow px-2" role="menu">
                            <span class="dropdown-item" id="settIddropdown">Pengaturan</span>
                            <div class="dropdown-divider"></div>
                            <x-link class="dropdown-item" role="presentation" :href="route('register')" method="POST">Keluar</x-link>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <div id="sidenavAccordion" class="sb-sidenav accordion">
                <div class="sb-sidenav-menu scrollBar">
                    <div class="nav mb-5">
                        @include('layouts.dashboard-menu')
                    </div>
                </div>
            </div>
        </div>
        <div id="layoutSidenav_content">
            <main class="bg-light">
                <div class="p-1 p-md-3 rounded-0 border-0 container-xxl">
                    @yield('content')
                </div>
            </main>
        </div>
        <div class="settings" id="settPanel">
            <div class="topPanel">
                <h3>Pengaturan</h3>
                <div class="close">
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="menusett">
                <div class="themeM">
                    Tema
                    <div>
                    <button id="default">Default</button>
                    <button id="light">Light</button>
                    <button class="apply" id="dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="<?= url('/admin/js/script.min.js') ?>"></script>
    <script src="<?= url('/admin/js/liveSearch.js') ?>"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            // adjust column sizing
            autoWidth: false,
        });
    </script>
    @yield('js')
</body>
</html>