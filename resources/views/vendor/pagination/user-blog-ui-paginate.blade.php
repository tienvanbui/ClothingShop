@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true" style="border-radius: 50%;margin-right:10px">
                        Trước</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')" style="border-radius: 50%;margin-right:10px;">
                        Trước </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link  how-pagination1 trans-04 "
                                    style=" border-radius: 50%;
                            text-align: center;
                            margin-right: 10px;
                        ">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link  how-pagination1 trans-04" href="{{ $url }}"
                                    style="  border-radius: 50%;
                                    text-align: center;
                                    margin-right: 10px;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next') " style="border-radius: 50%">Sau</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true" style="border-radius: 50%">Sau</span>
                </li>
            @endif
        </ul>
    </nav>

@endif
