@extends('layouts.dashboard')

@section('content')
    <div class="bg-white rounded p-2 w-100 mb-3">
        <button data-bs-toggle="modal" data-bs-target="#moadlUpaloadBook" class="btn btn-primary btn-sm">Tambah</button>
    </div>
    <div class="card">
        <div class="card-body">
            <x-alert.flash name="success" type="success" />
            <table class="table" id="table-books">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Judul</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="moadlUpaloadBook" tabindex="-1" aria-labelledby="moadlUpaloadBookLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <div class="row justify-content-center my-5">
                        <div class="col-10">
                            <x-alert.error name="file_book" />
                            <canvas id="pdf-canvas" class="d-none"></canvas>

                            <x-form :action="route('books.create')" id="form-book" method="POST" enctype="multipart/form-data">
                                <input type="file" id="file-book" name="file_book" class="d-none">
                                <input type="hidden" name="cover_book" id="cover_book">
                                <div class="d-flex flex-column p-3 border rounded-5 text-center">
                                    <h2>Upload Buku PDF</h2>

                                    <div class="text-center">
                                        <div id="pdf-preview" class="overflow-hidden mx-auto" style="max-width: 200px;">
                                            <img class="img-fluid border rounded" src="https://via.placeholder.com/150x200?text=Banner+PDF">
                                        </div>
                                        <small id="title-pdf"></small>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary btn-lg mb-3 mt-5" id="btn-browse-file" width="200px">
											Browse File
										</button>
                                    </div>
                                    <small>upload buku dengan format pdf</small>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        $(document).ready(function() {
            if($('#alert-file_book').length > 0) {
                $('#moadlUpaloadBook').modal('show');
            }
        });

        $('#table-books').DataTable({
            serverSide: true,
            processing: true,
            ajax: window.location.href,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'title',
                    render: function(data, type, row, meta) {
                        return `<div class="d-flex flex-column text-truncate" style="max-width: 400px">
						<span>${data}</span>
						<small class="text-muted">${row.slug}</small>
					</div>`;
                    }
                },
                {
                    data: 'action',
                    render: function(data, type, row, meta) {
                        const urlDelete = url('/books/' + row.slug)
                        let formDelete = `<x-link href="actionUrl" classform="form-delete" class="btn btn-sm btn-danger" method="DELETE" :btn="true">Hapus</x-link>`

                        return `
                            <a href="${url('/books/edit/' + row.slug)}" class="btn btn-sm btn-primary">Edit</a>
                            ${formDelete.replace('actionUrl', urlDelete)}
                        `;
                    }
                }
            ]
        })
		
		$('#btn-browse-file').click(function() {
			$('#file-book').click();
		})

        $('#table-books tbody').on('click', '.form-delete button[type=button]', function(e) {
            e.preventDefault();
            const button = $(this);

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Buku Akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parent().submit();
                }
            })
        })
    </script>

    <script>
        const canvas = document.getElementById('pdf-canvas');

        function makeImgFromCanvas(canvas) {
            // format the image with webp
            var img = document.createElement('img');
            img.classList.add('img-fluid', 'border', 'rounded')
            var imgBase64 = canvas.toDataURL('image/webp', 1.0)
            $('#cover_book').val(imgBase64)
            img.src = imgBase64;
            const container = document.getElementById('pdf-preview')
            container.innerHTML = ''
            container.appendChild(img)
            return img;
        }

        function loadPDFjsLib(file) {
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
            return pdfjsLib;
        }

        async function loadFilePDF(file) {
            return await pdfjsLib.getDocument(file).promise
        }

        function readFile(file){
            return new Promise((resolve, reject) => {
                var fr = new FileReader();  
                fr.onload = () => {
                    resolve(new Uint8Array(fr.result))
                };
                fr.onerror = reject;
                fr.readAsArrayBuffer(file);
            });
        }
        
        $('#file-book').change(async function() {
            const inputFile = this
            const nameFile = inputFile.files[0].name
            console.log('Loading a file', nameFile);
            $('#btn-browse-file').prop('disabled', true)
            $('#btn-browse-file').html(/*html*/`<div class="spinner-border text-light" role="status"></div>
            <span class="ms-2">Cheking..</span>`)
            
            $('#title-pdf').text(nameFile ?? '')

            try {
                const typedarray = await readFile(inputFile.files[0])
                console.log(typedarray)
                var pdf = await loadFilePDF(typedarray)
            } catch (error) {
                // Failed to fetch
                // Invalid PDF
                console.error('Error Loading PDF', error);
                $('#btn-browse-file').prop('disabled', false)
                alert(error.message);
                return false
            }
			
            const page = await pdf.getPage(1)
            console.log('Page 1 loaded');
            const viewport = page.getViewport({scale: 1});

            // Prepare canvas using PDF page dimensions
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            console.log('viewport', viewport)

            // Render PDF page into canvas context
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise
            console.log('Page rendered');

            makeImgFromCanvas(canvas)

            $('#btn-browse-file').html(/*html*/`<div class="spinner-border text-light" role="status"></div>
            <span class="ms-2">Uploading...</span>`)

            setTimeout(() => {
                $('#form-book').submit()
            }, 700);

		})
    </script>
@endsection

{{-- g5122111602501 --}}
