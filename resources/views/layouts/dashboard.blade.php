<!DOCTYPE html>
<html lang="en">

<head>
  <base href="">
  <title>Pustaka Sekolah</title>
  <meta charset="utf-8" />
  <meta name="description" content="Pustaka" />
  <meta name="keywords" content="Pustaka" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:locale" content="id_ID" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="Pustaka" />
  <meta property="og:url" content="https://keenthemes.com/metronic" />
  <meta property="og:site_name" content="Keenthemes | Metronic" />
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  @livewireStyles
  @livewireScripts
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
  @stack('head')
</head>

<body id="kt_body"
  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
  style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
  <div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
      <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
        data-kt-drawer-toggle="#kt_aside_mobile_toggle">
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
          <a href="../../demo1/dist/index.html">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-1-dark.svg') }}" class="h-25px logo" />
          </a>
          <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.5"
                  d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                  fill="black" />
                <path
                  d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                  fill="black" />
              </svg>
            </span>
          </div>
        </div>
        @include('layouts.dashboard-menu')
        <!--end::Aside menu-->
        <!--begin::Footer-->
        <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
          <a href="../../demo1/dist/documentation/getting-started.html" class="btn btn-custom btn-primary w-100"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
            title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs &amp; Components</span>
            <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
            <span class="svg-icon btn-icon svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3"
                  d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                  fill="black" />
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </a>
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Aside-->
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @include('layouts.dashboard-menu-top')
        <!--end::Header-->
        <!--begin::Content-->
        {{ $slot }}
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
          <!--begin::Container-->
          <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted fw-bold me-1">2021©</span>
              <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
              <li class="menu-item">
                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
              </li>
              <li class="menu-item">
                <a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
              </li>
              <li class="menu-item">
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
              </li>
            </ul>
            <!--end::Menu-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Root-->

  <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
        <path
          d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
          fill="black" />
      </svg>
    </span>
  </div>

  <script>
    var hostUrl = "{{ asset('assets') }}";
  </script>
  <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
  {{-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
  <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script> --}}
  <script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script>
  <script src="{{ asset('assets/js/custom/modals/upgrade-plan.js') }}"></script>
  @stack('script')
</body>

</html>