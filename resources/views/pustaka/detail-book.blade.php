<div class="card border-0 mb-3 text-dark">
  <div class="row no-gutters mt-md-3">
    <div class="col-12 pl-md-5 text-center d-md-none">
      <h5 class="card-title mb-3 mt-1 text-wrap text-center">{{ $book->title }}</h5>
    </div>
    <div class="col-3 col-md-3 pl-md-5 text-center">
      <img src="{{ $book->cover_url }}" class="card-img shadow-sm" style="max-width: 200px">
    </div>
    <div class="col-9 col-md-8">
      <div class="card-body pt-0">
        <h5 class="card-title mb-0 d-none d-md-block">{{ $book->title }}</h5>
        <p class="card-text my-0">
          <small class="text-muted">Unggah {{ $book->created_at->isoFormat('LLL') }}</small>
        </p>
        <p class="mt-0">
          <span class="badge badge-primary">Dibaca 0</span>
          <span class="badge badge-info" style="cursor: pointer" id="saveBook">
            simpan</span>
          <span class="badge badge-danger" style="cursor: pointer" id="jasuh">
            <span id="valLike">4</span>
          </span>
          <a class="badge badge-success" href="`+bUrl+`/unduh/`+result.items.idBuku+`"><i class="fa fa-download"></i>
            Unduh `+result.items.unduhan+`</a>
        </p>
        <div class="card-text my-auto">
          <ul class="font-weight-light list-unstyled" style="font-size: 15px;">
            <li class="text-wrap">Penulis : <p style="margin-left: 5px;">`+result.items.penulis+`</p>
            </li>
            <li class="text-wrap">Penerbit : <p style="margin-left: 5px;">`+result.items.penerbit+`</p>
            </li>
          </ul>
        </div>
        <a href="{{ url('baca/buku/') }}/{{ $book->slug }}" class="btn btn-primary btn-sm mt-auto"
          onClick="openBook(this)">Baca buku</a>
      </div>
    </div>
    <div class="col-12 col-md-8 mt-3">
      <div class="container p-3">
        <p class="text-wrap font-weight-lighter">`+result.items.deskripsi+`</p>
      </div>
    </div>
  </div>
</div>