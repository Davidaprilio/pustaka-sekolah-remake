@extends('layouts.adminlte.main', [
    'pageName' => 'Rak Buku',
    'breadcrumb' => 'Panel/Buku/Rak Buku'
])
@include('layouts.adminlte.resouces.datatable')

@section('content')
<div class="row">
    <div class="col-12 col-xl-7 mb-3">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <x-alert.flash name="cat_success" type="success" />
                <x-form :action="route('etalase.item')" method="POST" id="form-kategori" style="display: none" class="pb-2 mb-3 border-bottom">
                    <input type="hidden" name="item_id">
                    <div class="row">
                        <x-form.input col="col-6" label="Nama" name="name_cat" />
                        <x-form.select col="col-6" label="Group" name="group_id" :options="$groups->pluck('name', 'id')" />
                        <div class="col"></div>
                        <div class="col-6 mt-2 text-right">
                            <button id="btn-close-form-kategori" type="button" class="btn btn-sm btn-secondary">cancel</button>
                            <button class="btn btn-sm btn-primary">save</button>
                        </div>
                    </div>
                </x-form>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover" id="table-kategori">
                        <thead class="table-light">
                            <tr>
                                <td>No</td>
                                <td style="min-width: 120px">Nama Kategori</td>
                                <td style="min-width: 100px">Group</td>
                                <td style="min-width: 120px">Jumlah Buku</td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-primary rounded-0" id="btn-add-kategori">
                                        + Baru
                                    </button>
                                </td>
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
                                        <div class="btn-group float-right" data-id="{{ $e->id }}" data-name="{{ $e->name }}" data-gid="{{ $e->group->id }}">
                                            <button class="btn btn-sm btn-warning btn-edit">
                                                <i class="fa fs-6 fa-pen"></i>
                                            </button>
                                            @if ($e->books_count > 0)
                                            @php
                                                $title = "Tidak dapat menghapus kategori ini karena terdapat {$e->books_count} buku didalamnya";
                                            @endphp
                                                <button title="{{ $title }}" onclick="alert('{{ $title }}')" class="btn btn-sm btn-danger">
                                                    <i class="fa fs-6 fa-trash"></i>
                                                </button>
                                            @else
                                                <x-link class="btn btn-sm btn-danger" classform="form-item-delete" :href="route('etalase.item.delete', [
                                                    'etalaseBook' => $e->id,
                                                ])" method="DELETE">
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
        <div class="card card-primary card-outline overflow-hidden px-1">
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
                <table class="table mb-0 table-sm table-striped table-hover" id="table-groups">
                    <thead class="table-light">
                        <tr>
                            <td>No</td>
                            <td style="min-width: 120px">Nama Group</td>
                            <td style="min-width: 120px">kategori</td>
                            <td class="text-right">
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
@endsection

@push('scripts')
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
                $('#table-groups tbody').html(html);
            }).catch(err => {
                const alertEl = makeAlertFromError(err)
                if (alertEl) {
                    $('#alert-groups').append(alertEl);
                }
            })

            btn.attr('disabled', false);
            btn.html('save');

            makeSelect()
        })

        function closeFormGroup() {
            $('#form-groups').slideUp();
            $('#form-groups').trigger('reset');
            $('#group_id').val('');
        }

        $('#btn-add-groups').on('click', function() {
            $('#form-groups').slideDown();
            $('#form-groups').trigger('reset');
            $('#group_id').val('');

        })
        $('#btn-add-kategori').on('click', function() {
            $('#form-kategori').slideDown();
            $('#form-kategori').trigger('reset');
            $('#form-kategori input[name="item_id"]').val('');
        })

        $('#table-groups tbody').on('click', '.btn-edit', function() {
            const button = $(this)  
            const buttonGroup = button.parent();
            const dataID = buttonGroup.data('id');
            const nameGroup = buttonGroup.data('name');

            $('#group_id').val(dataID);
            $('#form-groups input[name="name"]').val(nameGroup);
            $('#form-groups').slideDown();
        })

        $('#btn-close-form-kategori').on('click', function() {
            $('#form-kategori').slideUp();
            $('#form-kategori').trigger('reset');
            $('#form-kategori input[name="item_id"]').val('');
        })
        
        $('#table-kategori tbody').on('click', '.btn-edit', function() {
            const button = $(this)
            const buttonGroup = button.parent();
            const dataID = buttonGroup.data('id');
            const nameKategori = buttonGroup.data('name');
            const idGroup = buttonGroup.data('gid');

            $('#name_cat-input').val(nameKategori);
            $('#group_id-select').val(idGroup);
            $('#form-kategori input[name="item_id"]').val(dataID);
            $('#form-kategori').slideDown();
        })

        $('#table-groups tbody').on('submit', '.form-group-delete', function(e) {
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
                        $('#table-groups tbody').html(html);
                    }).catch(err => {
                        const alertEl = makeAlertFromError(err)
                        if (alertEl) {
                            $('#alert-groups').append(alertEl);
                        } else {
                            console.error(err)
                        }
                    }).finally((res) => {
                        closeFormGroup()
                        makeSelect()
                    })
                }
            })
        })

        $('#table-kategori tbody').on('submit', '.form-item-delete', function(e) {
            const form = $(this);
            if (!form.hasClass('confirmed')) {
                e.preventDefault();

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
                        form.addClass('confirmed');
                        form.submit();
                    }
                })
            }
        })

        $('#form-groups input[name="name"]').on('keyup', function(e) {
            if (e.key === 'Escape') {
                closeFormGroup()
            }
        })

        function makeSelect() {
            const groups = $('#table-groups tbody tr').map(function(idx, tr) {
                const buttonGroup = $(this).find('.btn-group');
                const dataID = buttonGroup.data('id');
                const nameGroup = buttonGroup.data('name');
                return `<option value="${dataID}">${nameGroup}</option>`
            }).get().join('');
            $('#group_id-select').html(groups);
        }

        
    </script>
@endpush