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

                            <x-form :action="route('books.create')" id="form-book" method="POST" enctype="multipart/form-data">
                                <input type="file" id="file-book" name="file_book" class="d-none">
                                <div class="d-flex flex-column p-3 border rounded-5 text-center">
                                    <h2>Upload Buku PDF</h2>
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

		$('#file-book').change(function() {
			$('#btn-browse-file').html('<div class="spinner-border text-light" role="status"></div><span class="ms-2">Uploading...</span>')
			$('#form-book').submit()
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
@endsection
