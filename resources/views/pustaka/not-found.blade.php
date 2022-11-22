@extends('layouts.pustaka')


@section('main')
    @php
        if (isset($face_emot)) {
            $face_emot = [
                "（⊙ｏ⊙）",
                "(¬_¬ )",
                "＞﹏＜",
                "＞︿＜",
                "╯︿╰",
                "¯\_(ツ)_/¯"
            ];
            $face_emot = $face_emot[array_rand($face_emot)];
        } else {
            $face_emot = false;
        }
        $code = $code ?? 404;
        $errors_msg = [
            '404' => 'Halaman tidak ditemukan',
            '403' => 'Anda tidak memiliki akses ke halaman ini',
            '500' => 'Terjadi kesalahan pada server',
        ];
    @endphp
    <div class="container">
        <div class="row text-center justify-content-center align-items-center" style="height: 80vh">
            <div class="col-10 mt-3 text-secondary">
                @if ($face_emot)
                    <h1 class="display-1">{{ $face_emot }}</h1>
                @endif
                <h1 class="display-2">{{ $code }}</h1>
                <h4 class="fw-light mb-2">{{ $errors_msg[$code] ?? '' }}</h4>
            </div>
        </div>
    </div>

@endsection
