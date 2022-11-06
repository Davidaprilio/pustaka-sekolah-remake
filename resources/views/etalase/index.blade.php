@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12 col-xl-7 mb-3">
        <div class="card">
            <div class="card-body">
                <x-alert.flash name="success" type="success" />
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover" id="table-kategori">
                        <thead class="table-light">
                            <tr>
                                <td>No</td>
                                <td style="min-width: 120px">Nama Kategori</td>
                                <td style="min-width: 100px">Group</td>
                                <td style="min-width: 120px">Jumlah Buku</td>
                                <td class="text-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($etalases as $e)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->group->name ?? '-' }}</td>
                                    <td>{{ $e->books_count ?? 0 }} buku</td>
                                    <td>
                                        <div class="btn-group float-end">
                                            <button class="btn btn-sm btn-warning">
                                                <i class="fa fs-6 fa-pencil"></i>
                                            </button>
                                            @if ($e->books_count > 0)
                                                <button title="Tidak dapat menghapus kategori ini karena terdapat {{ $e->books_count }} buku didalamnya" class="btn btn-sm btn-danger">
                                                    <i class="fa fs-6 fa-trash"></i>
                                                </button>
                                            @else
                                                <x-link class="btn btn-sm btn-danger" :href="url($e->slug)" method="DELETE">
                                                    <i class="fa fs-6 fa-trash"></i>
                                                </x-link>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5 col-xxl-4">
        <div class="card overflow-hidden px-1">
            <div class="px-1 px-md-2 mb-2">
                <div id="alert-groups">
                    <x-alert.flash name="success" type="success" />
                </div>

                <x-form :action="route('etalase.group')" method="POST" id="form-groups" style="display: none" class="pt-2">
                    <div class="row">
                        <input type="hidden" id="group_id" name="group_id">
                        <div class="col-10">
                            <x-form.input name="name" placeholder="Nama group baru" />
                        </div>
                        <div class="col-2 ps-0">
                            <button class="btn btn-primary w-100">save</button>
                        </div>
                    </div>
                </x-form>
            </div>
            <div class="table-responsive-md">
                <table class="table mb-0 table-sm table-striped table-hover" id="table-kategori">
                    <thead class="table-light">
                        <tr>
                            <td>No</td>
                            <td style="min-width: 120px">Nama Group</td>
                            <td style="min-width: 120px">kategori</td>
                            <td class="text-end">
                                <button class="btn btn-xs btn-primary rounded-0" id="btn-add-groups">
                                    + Baru
                                </button>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @include('etalase.tbody-group', ['groups' => $groups])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Creat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@section('js')
    <script>
        const table = $('#table-kategori').DataTable({
            responsive: true,
            columnDefs: [
                {
                    targets: [4],
                    orderable: false
                }
            ]
        });

        $('#form-groups').on('submit', async function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            
            const btn = $('#form-groups button')
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-spin fa-spinner"></i>');

            await submitForm('#form-groups').then(html => {
                closeFormGroup()
                $('#table-kategori tbody').html(html);
            }).catch(err => {
                const alertEl = makeAlertFromError(err)
                if (alertEl) {
                    $('#alert-groups').append(alertEl);
                }
            });

            btn.attr('disabled', false);
            btn.html('save');
        })

        function closeFormGroup() {
            $('#form-groups').slideUp();
            $('#form-groups').trigger('reset');
            $('#group_id').val('');
        }

        $('#btn-add-groups').on('click', function() {
            $('#form-groups').slideDown();
        })

        $('#table-kategori tbody').on('click', '.btn-edit', function() {
            const button = $(this)
            const buttonGroup = button.parent();
            const dataID = buttonGroup.data('id');
            const nameGroup = buttonGroup.data('name');
            $('#group_id').val(dataID);
            $('#form-groups input[name="name"]').val(nameGroup);
            $('#form-groups').slideDown();
        })

        $('#table-kategori tbody').on('submit', '.form-group-delete', function(e) {
            e.preventDefault();
            const form = $(this);
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {

                    submitForm(form).then(html => {
                        $('#table-kategori tbody').html(html);
                    }).catch(err => {
                        const alertEl = makeAlertFromError(err)
                        if (alertEl) {
                            $('#alert-groups').append(alertEl);
                        } else {
                            console.error(err)
                        }
                    }).finally((res) => {
                        closeFormGroup()
                        console.log('finally', res, form)
                    })
                }
            })
        })
    </script>
@endsection