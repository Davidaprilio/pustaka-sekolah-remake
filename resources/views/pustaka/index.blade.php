@extends('layouts.pustaka')
@section('main')

<div class="alert alert-info d-none d-lg-block">Resize your browser to show the responsive offcanvas toggle.</div>

<div class="row mb-5">
  <div class="col-12 col-md-8 mb-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column flex-md-row">
          <img src="https://via.placeholder.com/220x300" width="250" class="img-fluid rounded mx-auto" alt="cover book">
          <div class="ms-3 flex-grow-1 mt-2 mt-md-0">
            <div class="d-flex flex-column">
              <h3 style="font-weight: 300" class="mb-0">Ini judul buku ku yang keren banget - eps1</h3>
              <small class="text-muted">pelajaran</small>
            </div>

            <div class="row mt-3">
              <div class="col mb-3">
                <button class="btn btn-primary w-100">Baca</button>
              </div>
              <div class="col">
                <div class="btn-group border w-100" role="group" aria-label="Button group with nested dropdown">
                  <button type="button" class="btn btn-light">Simpan</button>
                  <div class="btn-group" role="group">
                    <button id="drop-option" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="drop-option">
                      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-3">
          <h5 style="font-weight: 300" class="border-bottom">Deskripsi:</h5>
          <p style="font-size: 14px">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum neque ad obcaecati atque voluptatibus et veritatis perferendis eius quia illum adipisci assumenda, vero iste debitis amet praesentium quibusdam saepe inventore ex eos ducimus repellendus corrupti odio. Consequuntur, consectetur. Sunt provident quam nesciunt expedita quisquam, dicta tempore eos perferendis ex nam amet et sequi blanditiis voluptates dolores excepturi dolorum corrupti molestiae eveniet ut ipsum autem minus nulla! Dolorem, modi incidunt omnis eos minima nemo exercitationem nisi sint necessitatibus aliquid voluptate alias accusamus quis maxime eveniet fugit officiis. Explicabo illo laboriosam sunt sequi distinctio at vero? Reprehenderit obcaecati pariatur dolor ea omnis.</p>
        </div>

        <div class="mt-3">
          <h5 style="font-weight: 300" class="border-bottom">Detail buku:</h5>
          <div class="row">
            <div class="col-6">
              <ul class="list-unstyled">
                <li>Judul: 
                  <span style="font-weight: 300; font-size: 15px">Ini judul buku ku yang keren</span>
                </li>
                <li>Penulis: 
                  <span style="font-weight: 300; font-size: 15px">david</span>
                </li>
                <li>Penerbit: 
                  <span style="font-weight: 300; font-size: 15px">Grahamedia</span>
                </li>
              </ul>
            </div>
            <div class="col-6">
              <ul class="list-unstyled">
                <li>Genre: 
                  <span style="font-weight: 300; font-size: 15px">Pelajaran</span>
                </li>
                <li>Dibaca: 
                  <span style="font-weight: 300; font-size: 15px">124 kali</span>
                </li>
                <li>Di upload: 
                  <span style="font-weight: 300; font-size: 15px">12 Ags 2022</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>
  <div class="col-12 col-md-4 pe-lg-4">
    <div class="card p-2">
      <div class="row flex-column">
        @for ($i = 0; $i < 7; $i++)  
        <div class="col-12 mb-2">
          <div class="d-flex">
            <img src="https://via.placeholder.com/80x110" width="90" class="img-fluid rounded flex-shrink-0" alt="cover book">
            <div class="flex-grow-1 ms-2 d-flex flex-column" style="font-weight: 300">
              <a href="#" class="text-decoration-none text-dark text-hover-danger" style="line-height: 17px;">lorem ipsum dolor sit amet min</a>
              <small class="text-muted" style="font-size: 13px">lorem ipsum</small>
            </div>
          </div>
        </div>
        @endfor
      </div>
    </div>
  </div>
</div>
@endsection