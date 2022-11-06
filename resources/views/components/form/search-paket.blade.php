@php
    $maskapai = \App\Models\Paket::select('pesawat')->groupBy('pesawat')->pluck('pesawat');
@endphp
<form action="{{ url('paket') }}">
    <div class="main-search-input-item" style="width: 40%">
        <input type="text" name="judul" placeholder="Cari Paket Anda" value="{{ request()->get('judul') }}" />
    </div>
    <div class="main-search-input-item" style="width: 30%">
        <select id="lokasi-filter" data-placeholder="Kota Anda" class="chosen-select" name="kota">
            <option value="all">Semua</option>
            <option value="terdekat" {{ request()->get('kota') == 'terdekat' ? 'selected' : '' }}>Terdekat</option>
        </select>
    </div>
    <div class="main-search-input-item" style="width: 30%">
        <select data-placeholder="Maskapai" class="chosen-select" name="maskapai">
            <option value="all">Maskapai</option>
            @foreach ($maskapai as $ms)
            <option value="{{ $ms }}" {{ $ms === request()->get('maskapai') ? 'selected' : '' }}>{{ $ms }}</option>
            @endforeach
        </select>
    </div>
    <div class="main-search-input-item" style="width: 50%">
        @php $now = \Carbon\Carbon::now(); @endphp
        <select data-placeholder="Keberangkatan" class="chosen-select no-search-select" name="tanggal">
            <option value="all">Semua tanggal</option>
            {{-- print nama bulan human readeble --}}
            @foreach (range(1, 12) as $bulan)
                @php $tgl = $now->addMonth(1)->format('Y-m'); @endphp
                <option value="{{ $tgl }}" {{ ($tgl == request()->get('tanggal')) ? 'selected' : '' }} >
                    {{ $now->format('F Y') }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="main-search-input-item" style="width: 50%">
        <select data-placeholder="Paket" class="chosen-select no-search-select" name="harga">
            <option value="all">Harga</option>
            @foreach ([
                5_000_000 => 10_000_000,
                10_000_000 => 20_000_000,
                20_000_000 => 30_000_000,
                30_000_000 => 40_000_000,
                40_000_000 => 50_000_000,
                50_000_000 => 60_000_000,
                ] as $min => $max)
                <option value="{{ "{$min}-{$max}" }}" {{ ("{$min}-{$max}" == request()->get('harga')) ? 'selected' : '' }}>Rp. {{ dotNum($min) }} - Rp. {{ dotNum($max) }}
                </option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="location">
    <button class="main-search-button color-bg" type="submit" style="height: 100%; min-height: 40px">
        Cari <i class="far fa-search"></i>
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#lokasi-filter').on('change', async function() {
            await checkLokasi()
        });

        async function checkLokasi() {
            const val = $('#lokasi-filter').val();
            if (val === 'terdekat') {
                const loc = await getLocation();
                $('input[name="location"]').val(`${loc.lat},${loc.long}`);
            } else {
                $('input[name="location"]').val('');
            }
        }

        checkLokasi()
    });
</script>