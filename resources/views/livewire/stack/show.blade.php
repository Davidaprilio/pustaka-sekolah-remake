@push('head')
<link href="{{ asset('assets/plugins/custom/jkanban/jkanban.bundle.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/plugins/custom/jkanban/jkanban.bundle.js') }}"></script>
@endpush

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
      <!--begin::Page title-->
      <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
        data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
        class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard
          <!--begin::Separator-->
          <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
          <!--end::Separator-->
          <!--begin::Description-->
          <small class="text-muted fs-7 fw-bold my-1 ms-1">#XRS-45670</small>
          <!--end::Description-->
        </h1>
        <!--end::Title-->
      </div>
      <!--end::Page title-->
      <!--begin::Actions-->
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
              <div class="mb-5">
                <label class="form-label fw-bold">Kategori:</label>
                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option"
                  data-dropdown-parent="#kt_menu_615c3b188f30c" data-allow-clear="true">
                  <option disabled>pilih kategori</option>
                  <option value="1">Approved</option>
                  <option value="2">Pending</option>
                  <option value="2">In Process</option>
                  <option value="2">Rejected</option>
                </select>
              </div>
              <div class="mb-10">
                <label class="form-label fw-bold">Nama Rak:</label>
                <input class="form-control" type="text" />
              </div>
              <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                  data-kt-menu-dismiss="true">Batal</button>
                <button type="button" wire:click="" class="btn btn-sm btn-primary"
                  data-kt-menu-dismiss="true">Simpan</button>
              </div>
            </div>
            <!--end::Actions-->
          </div>
          <!--end::Form-->
        </div>
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
              <form wire:submit.prevent="addEtalase">
                <div class="form-group">
                  <label class="form-label fw-bold">Nama:</label>
                  <input class="form-control" wire:modal.defer="etalase" type="text" />
                </div>
                <div class="d-flex justify-content-end">
                  <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                    data-kt-menu-dismiss="true">Batal</button>
                  <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Simpan</button>
                </div>
              </form>
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
              <div id="kt_docs_jkanban_basic"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  var kanban = new jKanban({
    element: '#kt_docs_jkanban_basic',
    gutter: '0',
    widthBoard: '250px',
    boards: [
      {
        'id': '_inprocess',
        'title': 'In Process',
        'item': [
          {
            'title': '<span class="font-weight-bold">You can drag me too</span>'
          },
          {
            'title': '<span class="font-weight-bold">Buy Milk</span>'
          }
        ]
      }
    ],
    dropEl: function(el, to, from, sibling) {
      console.log(el, to, from, sibling);
      $wire.test()
    }
  });

  Livewire.on('created-stack', function(data) {
    kanban.add
  });
</script>
@endpush