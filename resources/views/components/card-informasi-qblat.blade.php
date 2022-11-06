@if ($info instanceof \App\Models\Informasi)
    <div class="post-story" style="padding: 30px 0 0 0">
        <h2>{{ $info->judul ?? '' }}</h2>

        <div class="post-story-info">
            <div class="date1">April 16, 2016</div>
            <div class="by">Posted by <a href="#">{{ $info->user->nama }}</a> / <a href="#">26</a> Comments
            </div>
        </div>

        <div class="post-story-body clearfix">
            {{-- <div class="big_letter">L</div> --}}
            <p>{{ $info->isi_konten }}</p>

        </div>
        <div class="post-story-link">
            <a href="{{ url('informasi/' . $info->id) }}" class="btn-default btn4">View</a>
        </div>
    </div>
@endif
