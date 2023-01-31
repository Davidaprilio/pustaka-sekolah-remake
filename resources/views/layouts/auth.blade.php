<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#a299aa">
    <meta name="msapplication-navbutton-color" content="#a299aa">
    <meta name="apple-mobile-web-app-status-bar-style" content="#a299aa">
    @include('layouts.meta', ['title' => $title])
    <title>Login Pustaka</title>
    {{-- <link rel="stylesheet" href="{{ url('/bootstrap/css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/login.css') }}">
    <style>
        body {
            background: url('{{ url("/img/bg-pattern.png") }}') repeat, 
                        /* linear-gradient(165deg, #a299aa 50%, #B7B7B7 50%); */
                        linear-gradient(165deg, #714700f2 50%, #55430E 50%);
        }
    </style>
</head>
<body>
	<div class="card form-signin needs-validation shadow" style="background-color: rgba(255, 255, 255, 0.81)">
	    <x-form url="login" method="POST" class="my-3">
	        <div class="text-center mb-4">
	            <img src="{{ url('/img/logo/pustakaL.png') }}" width="150">
	            <h3 class="my-3 fw-normal">Masuk Pustaka</h3>
	        </div>
            <div>
                <x-form.input ccol="form-label-group" name="email" placeholder="">
                    <label for="email-input">Username / Email</label>
                </x-form.input>
                <x-form.input ccol="form-label-group" name="password" type="password" placeholder="">
                    <label for="password-input">Password</label>
                </x-form.input>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> <small>Remember me</small>
                    </label>
                </div>
            </div>

	        <button class="btn btn-lg btn-primary w-100">Log in</button>
	    </x-form>

        <div class="mt-4 text-center fs-small">
            <p class="my-4">Jika kamu belum punya akun <a href="{{ url('/Pustaka/register'); }}">Daftar Sekarang</a></p>
            <p class="mt-2 mb-3 text-muted text-center">SMeKTa Internal Web &copy; 2020-2021</p>
        </div>
	</div>

    <script src="{{ url('/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ url('/bootstrap/js/popper.js') }}"></script>
</body>
</html>
