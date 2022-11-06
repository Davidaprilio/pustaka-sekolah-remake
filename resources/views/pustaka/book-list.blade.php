{{-- @dd($etalase_book instanceof \Illuminate\Database\Eloquent\Collection) --}}
@extends($is_ajax ? 'layouts.empty' : 'layouts.pustaka')
@section('main')
    @if ($etalase_book instanceof \Illuminate\Database\Eloquent\Collection)
        @foreach ($etalase_book as $stack)
            @if ($stack->books->count() > 0)
                <div class="drap rounded mb-1 p-2">
                    <div class="d-flex justify-content-between align-conten-center px-3 px-md-1">
                        <div class="">
                            <h5 class="m-0">{{ $stack->name }}</h5>
                            <small class="text-muted">Keterangan Rak Buku</small>
                        </div>
                        <span class="d-inline text-primary" id="moreBook_{{ $loop->iteration }}">Lainya</span>
                    </div>
                    <div class="mb-1 conten-scroll">
                        @foreach ($stack->books as $book)
                            <div class="card d-inline-block shadow-sm mb-1 mx-1" style="width: 150px">
                                <div class="w-100" style="border-bottom: 1px solid #eee;">
                                    <img src="{{ $book->cover_url }}" data-book-slug="{{ $book->slug }}"
                                        data-stack-slug="{{ $stack->slug }}"
                                        class="w-100 mx-auto img-cover-book cover-mini skeleton">
                                </div>
                                <div class="p-1 p-sm-2">
                                    <a href="#" class="text-dark my-0 py-0 buku_title text-truncate w-100 mb-1"
                                        title="{{ $book->title }}" data-book-slug="{{ $book->slug }}"
                                        data-stack-slug="{{ $stack->slug }}">
                                        {{ $book->title }}
                                    </a>
                                    <p class="d-block my-0 authorBook">
                                        <small class="text-muted">{{ $book->writer ?? '-' }}</small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        {{-- @if (count($stack->books) == 0)
                    <div class="border rounded p-5 w-100 text-muted h4 text-center">
                        Tidak Ada Buku
                    </div>
                @endif --}}
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="d-flex justify-content-between align-conten-center px-3 px-md-0 mb-3">
            <div class="">
                <h5 class="m-0">{{ $etalase_book->name }}</h5>
                <small class="text-muted">Keterangan Rak Buku</small>
            </div>
        </div>
        <div class="row mx-n1 mb-5" id="rowBook">
            @foreach ($etalase_book->books as $book)
                <div class="col-6 col-sm-auto p-0 mb-1">
                    <div class="card d-inline-block shadow-sm mb-1 mx-1 width-card">
                        <div class="w-100" style="border-bottom: 1px solid #eee;">
                            <img src="{{ $book->cover_url }}" data-book-slug="{{ $book->slug }}"
                                data-stack-slug="{{ $etalase_book->slug }}"
                                class="w-100 mx-auto img-cover-book cover-mini skeleton">
                        </div>
                        <div class="p-1 p-sm-2">
                            <a href="#" class="text-dark my-0 py-0 buku_title text-truncate w-100 mb-1"
                                title="{{ $book->title }}" data-book-slug="{{ $book->slug }}"
                                data-stack-slug="{{ $etalase_book->slug }}">
                                {{ $book->title }}
                            </a>
                            <p class="d-block my-0 authorBook text-truncate">
                                <small class="text-muted">{{ $book->writer ?? '-' }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($etalase_book->books) == 0)
                <div class="border rounded p-5 w-100 text-muted h4 text-center">
                    Tidak Ada Buku
                </div>
            @endif
        </div>
    @endif

@endsection
