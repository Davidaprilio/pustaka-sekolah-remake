@extends('layouts.dashboard')

@section('content')
<style>
    .width-card {
        min-width: 120px;
        max-width: 250px;
    }
</style>
<div class="card">
    <div class="card-body">
        <x-alert.flash name="success" />
        <x-form :action="route('books.edit', ['book' => $book->slug])" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-3">
                    <input type="file" class="d-none">
                    <div class="card d-inline-block shadow-sm mb-1 mx-1 width-card">
                        <div class="w-100" style="border-bottom: 1px solid #eee;">
                            <img src="{{ url('assets/media/books/1.png') }}" class="w-100 mx-auto img-cover-book cover-mini skeleton">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-sm btn-primary">ubah sampul</button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <x-form.input col="col-12 mb-1" label="Judul Buku" name="title" :default="$book->title" />
                        <x-form.input col="col-12 col-md-6 mb-1" label="Penulis" name="writer" :default="$book->writer" />
                        <x-form.input col="col-12 col-md-6 mb-1" label="Penerbit" name="publisher" :default="$book->publisher" />
                        <x-form.textarea col="col-12" label="Sinopsis/Deskripsi" name="desc" rows="7" :default="$book->description" />
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 float-end">Simpan</button>
                </div>
            </div>
        </x-form>
    </div>
</div>
@endsection

@section('js')
<script>
    function uploadFile() {
        $('#file-book').click();
    }
</script>
@endsection