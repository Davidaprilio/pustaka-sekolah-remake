@extends($is_ajax ? 'layouts.empty' : 'layouts.pustaka')
@section('main')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card border-0 mb-3 text-dark">
                <div class="card-body">
                    <div class="row no-gutters mt-md-3">
                        <div class="col-12 ps-md-5 d-md-none mt-2">
                            <h5 class="card-title mb-3 mt-1 text-wrap">{{ $book->title }}</h5>
                        </div>
                        <div class="col-4 col-md-3 text-end">
                            <img src="{{ $book->cover_url }}" class="card-img shadow-sm" style="max-width: 200px">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="pt-0 ps-1">
                                <h5 class="card-title mb-0 d-none d-md-block">{{ $book->title }}</h5>
                                <p class="card-text my-0">
                                    <small class="text-muted">Unggah {{ $book->created_at->isoFormat('LLL') }}</small>
                                </p>
                                <p class="mt-0">
                                    <span class="badge bg-primary">Dibaca {{ $book->read }}</span>
                                    <span class="badge bg-info" style="cursor: pointer" id="saveBook">simpan</span>
                                    <span class="badge bg-danger" style="cursor: pointer" id="jasuh">
                                        <span id="valLike">4</span>
                                    </span>
                                    <a class="badge badge-success" href="{{ url('/unduh') }}">
                                        <i class="fa fa-download"></i> Unduh {{ $book->download }}
                                    </a>
                                </p>
                                <div class="card-text my-auto">
                                    <ul class="font-weight-light list-unstyled" style="font-size: 15px;">
                                        <li class="text-wrap">
                                            Penulis : <span class="ms-1">{{ $book->writer }}</span>
                                        </li>
                                        <li class="text-wrap">
                                            Penerbit : <span class="ms-1">{{ $book->publisher }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ url("read/book/{$book->slug}") }}" class="btn btn-primary btn-sm mt-auto"
                                    onClick="openBook(this)">
                                    Baca buku
                                </a>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div>
                                <h5>Deskripsi</h5>
                                <p class="text-wrap font-weight-lighter" style="font-size: 14px">{{ $book->description }}</p>
                            </div>
    
                            <div>
                                <h5>Detail Buku</h5>
                                <div class="row" style="font-size: 14px">
                                    @foreach ([
                                        'Judul' => $book->title,
                                        'Penerbit' => $book->publisher,
                                        'Penulis' => $book->writer,
                                        'Author' => $book->author,
                                        'Halaman' => $book->pages,
                                        'No. Buku' => $book->num_book,
                                    ] as $label => $value)
                                        <div class="col-6">
                                            <strong>{{ $label }}</strong>
                                            <span>: {{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card">
            
            </div>
        </div>
    </div>
@endsection
