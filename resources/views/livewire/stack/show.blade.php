<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
      <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
        data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
        class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard
          <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
          <small class="text-muted fs-7 fw-bold my-1 ms-1">#XRS-45670</small>
        </h1>
      </div>
      <div class="d-flex align-items-center py-1">
        <div class="me-4">
          <!--begin::Menu-->
          <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end">
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
              <i class="fa fa-plus"></i>
            </span>
            Rak buku
          </a>
          <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
            id="kt_menu_615c3b188f30c">
            <div class="px-7 py-5">
              <div class="fs-5 text-dark fw-bolder">Tambah Rak Buku</div>
            </div>
            <div class="separator border-gray-200"></div>
            <div class="px-7 py-5">
              <form wire:submit.prevent="addStack">
                <div class="mb-5">
                  <label class="form-label fw-bold">Kategori:</label>
                  <select class="form-select form-select-solid" wire:model.defer="create_stack.group_id">
                    @foreach ($menu_etalase as $etalase)
                    <option @if ($loop->iteration) selected @endif value="{{ $etalase->id }}">{{ $etalase->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-10">
                  <label class="form-label fw-bold">Nama Rak:</label>
                  <input class="form-control" wire:model.defer="create_stack.name" type="text" />
                </div>
                <div class="d-flex justify-content-end">
                  <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                    data-kt-menu-dismiss="true">Batal</button>
                  <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Simpan</button>
                </div>
              </form>
            </div>
            <!--end::Actions-->
          </div>
          <!--end::Form-->
        </div>
        {{-- + Etalase --}}
        <div class="me-4">
          <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end">
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
              <i class="fa fa-plus"></i>
            </span>
            Etalase
          </a>
          <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
            id="kt_menu_615c3b188f30c">
            <div class="px-7 py-5">
              <div class="fs-5 text-dark fw-bolder">Tambah Etalase</div>
            </div>
            <div class="separator border-gray-200"></div>
            <div class="mb-5 px-7 py-5">
              <div class="form-group">
                <label class="form-label fw-bold">Nama:</label>
                <input class="form-control" wire:model.defer="etalase" type="text" />
              </div>
              <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                  data-kt-menu-dismiss="true">Batal</button>
                <button type="button" wire:click="addEtalase" class="btn btn-sm btn-primary"
                  data-kt-menu-dismiss="true">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
      <div class="row gy-5 g-xl-8">
        <div class="col-12">
          <div class="card card-xl-stretch mb-5 mb-xl-8">
            <div class="card-body">
              <div class="row">
                @foreach ($menu_etalase as $menu)
                @livewire('stack.card-etalase', ['etalaseGroup' => $menu], key($menu->id))
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>