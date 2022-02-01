<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Petugas Perpustakaan</title>
  <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/admin/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pustaka.css') }}">
  <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400&display=swap');

    .raleway {
      font-family: 'Raleway', sans-serif;
    }

    .toast {
      width: 100vh;
    }
  </style>
</head>

<body class="sb-nav-fixed bg-light">
  <nav class="navbar navbar-expand shadow-sm bg-navG sticky-top sb-topnav py-0 border-bottom border-warning">
    <div class="container-fluid">
      <button class="btn btn-link btn-sm ml-2 text-light" id="sidebarToggle" type="button">
        <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand d-flex" href="/Administrator">
        <img src="/img/logo/pustakaM.png">
        <div class="brand-txt">
          <h4 class="mb-0">Pustaka</h4>
          <small class="d-block">Perpustakaan Sekolah</small>
        </div>
      </a>
      <div class="">
        <a href="{{ route('login') }}" class="btn btn-warning btn-sm">Login</a>
      </div>
    </div>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <div id="sidenavAccordion" class="sb-sidenav accordion">
        <div class="sb-sidenav-menu scrollBar">
          @include('layouts.pustaka-menu')
        </div>
      </div>
    </div>
    <div id="layoutSidenav_content">
      <main class="bg-light container mt-4" style="overflow-x: hidden;" id="book-list">
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

  <script>
    const bashurl = "{{ url('/') }}";
  </script>
  <script src="{{ asset('/admin/js/script.min.js') }}"></script>
  <script src="{{ asset('/js/pustaka.js') }}"></script>
  {{-- <script src="{{ asset('/admin/js/liveSearch.js') }}"></script> --}}
</body>

</html>