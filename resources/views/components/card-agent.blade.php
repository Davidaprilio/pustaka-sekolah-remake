<div class="slick-slide-item">
    <style>
        .bg.par-elem.custom-banner {
            background-size: contain !important;
            background-repeat: no-repeat !important;
            background-origin: content-box !important;
        }

        .bg-wrap.bg-parallax-wrap-gradien::after {
            content: '';
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            background-image: url("https://www.pngitem.com/pimgs/m/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png");
            filter: blur(10px);
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-attachment: scroll;
            background-position: center;
            background-repeat: no-repeat;
            background-origin: content-box;
        }

        .bg-img-contain {
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
    <!--  agent card item -->
    <div class="listing-item">
        <article class="geodir-category-listing fl-wrap">
            <div class="geodir-category-img fl-wrap agent_card">
                <a href="#" class="geodir-category-img_item">
                    <div class="custom-image bg-img-contain"
                        style="background-image: url({{ $agent->photo ?? 'https://www.pngitem.com/pimgs/m/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png' }}); height: 200px">
                    </div>
                    {{-- <img class="custom-image"
                        src="{{ $agent->photo ?? 'https://www.pngitem.com/pimgs/m/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png' }}"
                        style="" alt=""> --}}
                </a>
            </div>
            <div class="geodir-category-content fl-wrap">
                <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i
                        class="fal fa-user-check"></i></div><br><br>
                <div class="agent_card-title fl-wrap">
                    <?php
                    $nama       = ucwords(strtolower($agent->nama));
                    $kecamatan  = ucwords(strtolower($agent->kecamatan));
                    $kota       = ucwords(strtolower($agent->kota));
                    $provinsi   = ucwords(strtolower($agent->provinsi));
                    ?>
                    <h5 style="font-weight: bold"><a href="javascript:void(0)">{{ $nama }}</a></h5>
                    <h5><a href="javascript:void(0)">{{ $kecamatan }},
                            {{ $kota }}, {{ $provinsi }}</a>
                    </h5>
                </div>
                <p>{{ $agent->cw_promo }}</p>
                <div class="geodir-category-footer fl-wrap">
                    <a target="_blank" href="https://wa.me/{{ $agent->phone }}" class="tolt ftr-btn"
                        data-microtip-position="left" data-tooltip="Kirim Pesan"><i class="fal fa-envelope"></i></a>
                    <a href="tel:{{ $agent->phone }}" class="tolt ftr-btn" data-microtip-position="left"
                        data-tooltip="Hubungi Sekarang"><i class="fal fa-phone"></i></a>
                </div>
            </div>
        </article>
    </div>
</div>
