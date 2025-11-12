@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-first disabled" aria-disabled="true" aria-label="««">
                <span aria-hidden="true">««</span>
            </li>
        @else
            <li class="page-first">
                <a href="{{ $paginator->url(1) }}" rel="first" aria-label="««">««</a>
            </li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-prev disabled" aria-disabled="true" aria-label="«">
                <span aria-hidden="true">«</span>
            </li>
        @else
            <li class="page-prev">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="«">«</a>
            </li>
        @endif

        {{-- Pagination Elements (Laravel builds $elements with pages and separators) --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>…</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @php($label = str_pad($page, 2, '0', STR_PAD_LEFT))
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span class="jv-gradient">{{ $label }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $label }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-next">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="»">»</a>
            </li>
        @else
            <li class="page-next disabled" aria-disabled="true" aria-label="»">
                <span aria-hidden="true">»</span>
            </li>
        @endif

        {{-- Last Page Link --}}
        @php($lastPage = $paginator->lastPage())
        @if ($paginator->currentPage() == $lastPage)
            <li class="page-last disabled" aria-disabled="true" aria-label="»»">
                <span aria-hidden="true">»»</span>
            </li>
        @else
            <li class="page-last">
                <a href="{{ $paginator->url($lastPage) }}" rel="last" aria-label="»»">»»</a>
            </li>
        @endif
    </ul>
@endif
