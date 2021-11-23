@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        {{-- Pagination Elements --}}
        <ul class="pagination-list custom-list">

            {{-- Previous Page Link --}}
{{--            todo: find how to use without the need for the mt-1 class --}}
            @if ($paginator->onFirstPage())
                <li class="mt-1">
                    <a class="button is-small pagination-link" disabled>
                        &lsaquo;
                    </a>
                </li>
            @else
                <li class="mt-1">
                    <a class="button is-small pagination-link" href="{{ $paginator->previousPageUrl() }}">
                        &lsaquo;
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="button is-small pagination-ellipsis">&hellip;</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a class="button is-small pagination-link is-current" aria-label="Goto page {{ $page }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="button is-small pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="button is-small pagination-link" href="{{ $paginator->nextPageUrl() }}">
                        &rsaquo;
                    </a>
                </li>
            @else
                <li>
                    <a class="button is-small pagination-link" disabled>
                        &rsaquo;
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
