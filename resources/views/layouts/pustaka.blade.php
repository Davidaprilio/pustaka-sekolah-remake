<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Petugas Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/skeleton-loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pustaka.css') }}">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'
        integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=='
        crossorigin='anonymous'></script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap');

        * {
            font-family: 'Roboto', sans-serif;
        }

        .raleway {
            font-family: 'Raleway', sans-serif;
        }

        .toast {
            width: 100vh;
        }

        .img-cover-book.cover-mini {
            width: 175px;
        }

        .scroll-bar-custom::-webkit-scrollbar {
            width: 1em;
        }

        .scroll-bar-custom::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .scroll-bar-custom::-webkit-scrollbar-thumb {
            background-color: darkgrey;
            outline: 1px solid slategrey;
        }

        .sb-topnav .navbar-brand {
            min-width: auto;
            max-width: none;
            width: auto;
        }
    </style>
</head>

<body class="sb-nav-fixed bg-light">
    <div class="d-flex flex-column">
        <nav class="navbar navbar-expand shadow-sm bg-navG sticky-top sb-topnav py-0 border-bottom border-warning">
            <div class="container-xxl w-100">
                <div class="row w-100 align-content-center justify-content-between">
                    <div class="col-2 col-md-4 d-flex d-lg-none align-items-center">
                        <button class="btn btn-link btn-sm ms-2 text-light" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#sideBar-menu" aria-controls="sideBar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="col-auto col-md-4">
                        <a class="navbar-brand d-flex justify-content-center justify-content-md-start align-items-center"
                            href="/Administrator">
                            <img src="/img/logo/pustakaM.png">
                            <div class="brand-txt mb-2 d-none d-sm-block">
                                <h4 class="mb-0">Pustaka</h4>
                                <small class="d-block">Perpustakaan Sekolah</small>
                            </div>
                        </a>
                    </div>

                    <div class="col-4 d-none d-lg-flex align-items-center">
                        <div class="input-group my-auto">
                            <input type="text" class="form-control" style="border-right-color: transparent;"
                                placeholder="Cari Buku ..." aria-describedby="btnSearch" id="search-Book">
                            <button class="btn btn-light border" type="button" id="btnSearch">
                                <i class="fa fa-search text-muted"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-2 col-md-4 text-end d-flex align-items-center justify-content-end pe-0">
                        <a href="{{ route('login') }}" class="btn btn-warning btn-sm">Login</a>
                    </div>
                </div>
            </div>
            <div class="progress" id="loading-bar" style="height: 3px; display: none">
                <div class="progress-bar" role="progressbar" id="loading-page-value" style="width: 25%;"></div>
            </div>
        </nav>

          
    </div>

    <div class="container-xxl p-0 d-flex mt-5">
        <div class="flex-shrink-0">
            <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sideBar-menu" aria-labelledby="sideBarLabel"
                style="width: 288px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sideBarLabel">Responsive offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sideBar-menu"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    @include('layouts.pustaka-menu')
                </div>
            </div>
        </div>
        <div class="flex-grow-1" style="width: calc(100% - 280px);">
            <main class="bg-light container-xxl px-0 px-md-3 mt-4" style="overflow-x: hidden;" id="book-list">
                @yield('main')
            </main>
        </div>
        <div class="d-none" id="tag-info"></div>
    </div>


    <div class="position-fixed" style="bottom: 0; right: 0; z-index: 10">
        <div aria-live="polite" aria-atomic="true" class="position-relative" style="min-height: 200px;">
            <div class="position-absolute" onshow="console.log('loaded');" id="containerToast"
                style=" bottom: 10px; right: 5px;">
                <!-- Then put toasts within -->
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        const bashurl = "{{ url('/') }}";
    </script>
    <script src="{{ asset('/admin/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/pustaka.js') }}"></script>
    {{-- <script src="{{ asset('/admin/js/liveSearch.js') }}"></script> --}}
</body>

</html>
