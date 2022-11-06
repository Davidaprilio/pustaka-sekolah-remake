@if ($paket instanceof \App\Models\Paket)
    @php
        if ($paket->jamaah_count === null) {
            throw new Exception("Paket tidak ada relasi jumlah jamaah, Tambahkan: \$paket->loadCount('jamaah') atau Paket::withCount('jamaah')");
        }
    @endphp

    <div class="listing-item">
        <article class="geodir-category-listing fl-wrap">
            <div class="geodir-category-img fl-wrap">
                <a href="{{ url('paket/' . $paket->kode_paket_cloning) }}" class="geodir-category-img_item black-bottom">
                    <img src="{{ $paket->gambar ?? 'https://terminalumroh.com/file-pesawat/file_pesawat1659927162.png' }}"
                        style="height: 300px" alt="">
                    <div class="overlay"></div>
                </a>
                <div class="geodir-category-location">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ "{$paket->lat}, {$paket->long}" }}"
                        target="_blank" class="single-map-item tolt" data-newlatitude="{{ $paket->lat }}"
                        data-newlongitude="{{ $paket->long }}" data-microtip-position="top-left"
                        data-tooltip="Lihat di google maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $paket->pemilik->kota }}, {{ $paket->pemilik->provinsi }}</span>
                    </a>
                </div>
                <ul class="list-single-opt_header_cat">
                    <li><a href="#" class="cat-opt blue-bg">{{ $paket->jenis_paket }}</a></li>
                </ul>
                <div class="geodir-category-listing_media-list">
                    <span title="{{ $paket->jml_dilihat }}x dilihat">
                        <i class="fas fa-eye"></i>{{ $paket->jml_dilihat }}
                    </span>
                    <span title="97 jamaah sudah terdaftar">
                        <i class="fas fa-users"></i> {{ $paket->jamaah_count }}
                    </span>
                </div>
            </div>
            <div class="geodir-category-content fl-wrap">
                <h3 class="title-sin_item" style="height: 50px !important;" title="{{ $paket->nama }}">
                    <a href="{{ url('paket/' . $paket->slug) }}">{{ str($paket->nama)->limit(45) }}</a>
                </h3><br>
                {{-- <a href="{{ url('register?paket_id=' . $paket->id) }}"
                    class="btn float-btn color-bg small-btn">Daftar</a> --}}
                <div class="geodir-category-content_price">Rp. {{ dotNum($paket->harga_paket ?? 0) }}
                </div>
                {{-- <p>{!! $paket->keterangan !!}</p> --}}
                <div class="geodir-category-content-details">
                    <ul style="display: flex; flex-direction: column; align-items: flex-start">
                        <li><i class="fal fa-bed"></i><span>{{ $paket->durasi }} Hari</span></li>
                        <li><i class="fal fa-plane"></i><span>{{ $paket->pesawat }}</span>
                        </li>
                        <li><i class="fal fa-calendar"></i><span>{{ $paket->tgl_berangkat->isoFormat('LL') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="geodir-category-footer fl-wrap">
                    <a href="agent-single.html" class="gcf-company">
                        <img src="{{ $paket->gambar }}" alt=""><span>Terminal Umroh</span></a>
                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top"
                        data-tooltip="Agent Bintang {{ $paket->hotelmekkah->bintang ?? ($paket->hotelmadinah->bintang ?? '4') }}"
                        data-starrating2="{{ $paket->hotelmekkah->bintang ?? ($paket->hotelmadinah->bintang ?? '4') }}">
                    </div>
                </div>
            </div>
        </article>
    </div>
@else
    @php
        throw new Exception(':paket harus instance dari \App\Models\Paket');
    @endphp
@endif
