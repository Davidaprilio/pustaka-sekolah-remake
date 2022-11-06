@extends('layouts.pustaka')
@section('main')
    <div class="d-flex flex-wrap d-md-block">
        @for ($i = 0; $i < 30; $i++)
            <div class="card mx-auto d-inline-block overflow-hidden me-0 me-sm-2 mb-2 book-wd">
                <img src="https://via.placeholder.com/170x240" alt="cover_book" class="img-fluid">
                <div class="px-1 py-2">
                    <a href="#" class="text-dark my-0 py-0 buku_title text-decoration-none" title="Buku"
                        data-book-slug="buku" data-stack-slug="buku">Lorem ipsum dolor sit amet consectetur</a>
                    <p class="d-block my-0 authorBook">
                        <small class="text-muted">lorem ipsum</small>
                    </p>
                </div>
            </div>
        @endfor
    </div>
@endsection
