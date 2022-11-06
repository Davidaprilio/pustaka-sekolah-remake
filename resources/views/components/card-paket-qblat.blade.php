@if ($paket instanceof \App\Models\Paket)
    @php
        if ($paket->jamaah_count === null) {
            throw new Exception("Paket tidak ada relasi jumlah jamaah, Tambahkan: \$paket->loadCount('jamaah') atau Paket::withCount('jamaah')");
        }
    @endphp

    <style>
        .bg-img-contain {
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>

    <div class="thumb5">
        <div class="thumbnail clearfix">
            <figure>
                <div class="custom-image bg-img-contain"
                    style="background-image: url({{ $paket->gambar ?? 'https://qblat.com/file-pesawat/file_pesawat1659927162.png' }}); height: 190px">
                </div>
                {{-- <div class="bg-image-contain">
                    <img src="{{ $paket->gambar ?? 'https://qblat.com/file-pesawat/file_pesawat1659927162.png' }}"
                        alt="" class="img-responsive" style="height: 200px">
                </div> --}}

                <div class="over">
                    <div class="v1">{{ $paket->nama }} </div>
                    {{-- <div class="v2">Twin / Double Room</div> --}}
                </div>
            </figure>
            <div class="caption">
                <div class="col-lg-12">
                    <span style="color: black"><i class="fa fa-eye"></i> &emsp;{{ $paket->jml_dilihat }} Orang</span>
                </div>
                <div class="col-lg-12">
                    <span style="color: black"><i class="fa fa-calendar"></i> &emsp; {{ $paket->durasi }} Hari</span>
                </div>
                <br>
                <div class="col-lg-12">
                    <span style="color: black"><i class="fa fa-map-marker"></i> &emsp;
                        {{ $paket->pemilik->kota ?? '-' }}</span>
                </div>
                <div class="col-lg-12">
                    <span style="color: black"><i class="fa fa-plane"></i> &emsp;
                        {{ $paket->pesawat }}
                    </span>
                </div><br><br>
                <div class="txt1" style="font-size: 16px">{{ $paket->nama ?? '-' }}</div>
                {{-- <div class="txt2" id="blog-list">{!! $paket->keterangan ?? '-' !!}</div> --}}
                <div class="txt3 clearfix">
                    <div class="left_side">
                        <div class="price">Rp. {{ dotNum($paket->harga_paket ?? '0') }}</div>
                        <div class="stars2">
                            {{-- @dump($paket->hotelmekkah->bintang) --}}
                            @if ($paket->hotelmekkah->bintang ?? '4' == 1)
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                            @elseif($paket->hotelmekkah->bintang ?? '4' == 2)
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                            @elseif($paket->hotelmekkah->bintang ?? '4' == 3)
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                            @elseif($paket->hotelmekkah->bintang ?? '4' == 4)
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star2.png') }}" alt="">
                            @elseif($paket->hotelmekkah->bintang ?? '4' == 5)
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                                <img src="{{ url('assets/qblat/images/star1.png') }}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="right_side"><a href="{{ url('paket/show?id=' . $paket->id) }}"
                            class="btn-default btn1">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    @php
        throw new Exception(':paket harus instance dari \App\Models\Paket');
    @endphp
@endif
