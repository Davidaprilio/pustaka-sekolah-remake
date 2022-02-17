<tr>
    <td>
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px me-5">
                <img src="{{ asset('assets/media/avatars/150-11.jpg') }}" alt="" />
            </div>
            <div class="d-flex justify-content-start flex-column">
                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $book->title }}</a>
                <span class="text-muted fw-bold text-muted d-block fs-7">{{ $book->slug ?? '-'
                    }}</span>
            </div>
        </div>
    </td>
    <td>
        <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $book->writer ?? '-'
            }}</a>
        <span class="text-muted fw-bold text-muted d-block fs-7">{{ $book->publisher ?? '- ' }}</span>
    </td>
    <td class="text-end">
        <div class="d-flex flex-column w-100 me-2">
            <div class="d-flex flex-stack mb-2">
                <span class="text-muted me-2 fs-7 fw-bold">50%</span>
            </div>
            <div class="progress h-6px w-100">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-end flex-shrink-0">
            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                            fill="black" />
                        <path opacity="0.3"
                            d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                            fill="black" />
                        <path
                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
            <button wire:click="delete({{ $book->id }})"
                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                <span class="svg-icon svg-icon-3"><i class="fa fa-trash"></i></span>
            </button>
        </div>
    </td>
</tr>