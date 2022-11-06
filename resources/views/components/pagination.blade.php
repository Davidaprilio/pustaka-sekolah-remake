<style>
    .pagination {
        display: flex;
        justify-content: center
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
@if ($page->lastPage() > 1)
    <ul class="pagination ml-auto">
        <li class="{{ $page->currentPage() == 1 ? ' disabled' : '' }} page-item">
            <a class="{{ $page->currentPage() == 1 ? ' disabled' : '' }} page-link " href="{{ $page->url(1) }}"
                aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @for ($i = 1; $i <= $page->lastPage(); $i++)
            <li class="{{ $page->currentPage() == $i ? ' active' : '' }} page-item">
                <a class=" page-link " href="{{ $page->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ $page->currentPage() == $page->lastPage() ? ' disabled' : '' }} page-item">
            <a href="{{ $page->url($page->currentPage() + 1) }}"
                class=" {{ $page->currentPage() == $page->lastPage() ? ' disabled' : '' }} page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
@endif
