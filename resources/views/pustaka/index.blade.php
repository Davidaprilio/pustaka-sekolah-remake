@extends('layouts.pustaka')
@section('main')

<div class="alert alert-info d-none d-lg-block">Resize your browser to show the responsive offcanvas toggle.</div>


<div class="bg-white px-3 pt-3 pb-1 rounded-3 shadow-sm border">
  <div class="conten-scroll rounded-3 scrollBar">
    @for ($i = 0; $i < 6; $i++)
    <div class="card mx-auto d-inline-block overflow-hidden me-2">
      <img src="https://via.placeholder.com/175x250" width="175px" alt="cover_book" class="img-fluid">
      <div class="px-1 py-2">
        <a href="#" class="text-dark my-0 py-0 buku_title text-decoration-none" title="Buku" data-book-slug="buku"
          data-stack-slug="buku">Ini Dia Judul Buku ku</a>
        <p class="d-block my-0 authorBook">
          <small class="text-muted">Penulis</small>
        </p>
      </div>
    </div>
    @endfor
  </div>
</div>
@endsection