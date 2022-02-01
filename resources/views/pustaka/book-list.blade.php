{{-- @dd($etalase_book instanceof \Illuminate\Database\Eloquent\Collection) --}}

@if ($etalase_book instanceof \Illuminate\Database\Eloquent\Collection)
@foreach ($etalase_book as $stack)
<div class="drap rounded mb-1 p-2">
  <div class="d-flex justify-content-between align-conten-center">
    <div class="">
      <h5 class="m-0">Kategori Buku</h5>
      <small class="text-muted">Deskripsi Buku</small>
    </div>
    <span class="d-inline text-primary" id="moreBook">Lainya</span>
  </div>
  <div class="mb-1 conten-scroll" id="dtlbk`+noInd+`">
    @foreach ($stack->books as $item)
    <div class="card d-inline-block shadow-sm mb-1 mx-1">
      <img src="{{ $item->book->cover_url }}" data-book-slug="{{ $item->book->slug }}"
        data-stack-slug="{{ $stack->slug }}" class="card-img-top mx-auto img-cover-book">
      <div class="p-1 p-sm-2">
        <a href="#" class="text-dark my-0 py-0 buku_title" title="{{ $item->book->title }}"
          data-book-slug="{{ $item->book->slug }}" data-stack-slug="{{ $stack->slug }}">{{
          Str::of($item->book->title)->limit(20) }}</a>
        <p class="d-block my-0 authorBook">
          <small class="text-muted">{{ $item->book->writer ?? '-' }}</small>
        </p>
      </div>
    </div>
    @endforeach
    @if (count($stack->books) == 0)
    <div class="border rounded p-5 w-100 text-muted h4 text-center">
      Tidak Ada Buku
    </div>
    @endif
  </div>
</div>
@endforeach
@else
<div class="d-flex justify-content-between align-conten-center">
  <div class="">
    <h5 class="m-0">{{ $etalase_book->name }}</h5>
    <small class="text-muted">{{ $etalase_book->desc ?? '' }}</small>
  </div>
  <span class="d-inline text-primary" id="moreBook">Lainya</span>
</div>
<div class="row mx-n1" id="rowBook">
  @foreach ($etalase_book->books as $item)
  <div class="col-2">
    <div class="card d-inline-block shadow-sm mb-1 mx-sm-1 overflow-hidden">
      <img src="{{ $item->book->cover_url }}" class="card-img-top mx-auto img-cover-book"
        data-book-slug="{{ $item->book->slug }}" data-stack-slug="{{ $etalase_book->slug }}">
      <div class="p-1 p-sm-2">
        <a href="#" class="text-dark my-0 py-0 buku_title" title="{{ $item->book->title }}"
          data-book-slug="{{ $item->book->slug }}" data-stack-slug="{{ $etalase_book->slug }}">{{
          Str::of($item->book->title)->limit(20) }}</a>
        <p class="d-block my-0 authorBook">
          <small class="text-muted">{{ $item->book->writer ?? '-' }}</small>
        </p>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif