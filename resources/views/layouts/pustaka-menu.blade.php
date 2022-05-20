<div class="nav mb-5 text-dark mx-1" id="menu-book-stack">
  <div class="mt-4 pr-2">

    <div class="input-group mb-3">
      <input type="text" class="form-control" style="border-right-color: transparent;" placeholder="Cari Buku ..."
        aria-describedby="btnSearch" id="search-Book">
      <button class="btn btn-light border" type="button" id="btnSearch">
        <i class="fa fa-search text-muted"></i>
      </button>
    </div>

    <a class="btn btn-warning w-100 nav-link text-dark" href="{{ url('semua-buku') }}" data-stack-slug="semua-buku">
      Semua buku
    </a>
  </div>
  <div>
    @foreach ($etalase_menu as $etalase)
    <div class="sb-sidenav-menu-heading">
      <span>{{ $etalase['name'] }}</span>
    </div>
    @foreach ($etalase['stack'] as $name => $slug)
    <a class="nav-link text-dark" href="/{{ $slug }}" data-stack-slug="{{ $slug }}">
      <span>{{ $name }}</span>
    </a>
    @endforeach
    @endforeach
  </div>
</div>