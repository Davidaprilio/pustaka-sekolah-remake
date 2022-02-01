<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
  <base href="../../../">
  <title>Metronic</title>
  <meta charset="utf-8" />
  <meta name="description" content="Tfree." />
  <meta name="keywords" content="Metronic" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="Metronic" />
  <meta property="og:url" content="https://keenthemes.com/metronic" />
  <meta property="og:site_name" content="Keenthemes" />
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Global Stylesheets Bundle(used by all pages)-->
  <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
  <!--begin::Main-->
  @yield('main')
  <!--end::Main-->
  <script>
    var hostUrl = "{{ asset('assets/') }}";
  </script>
  <!--begin::Javascript-->
  <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script> --}}
  <!--end::Javascript-->
</body>
<!--end::Body-->

</html>