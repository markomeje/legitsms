@if ($paginator->hasPages())
    <nav class="alert alert-info m-0">
        <ul class="d-flex align-items-center flex-wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled me-2" aria-disabled="true">
                    <span aria-hidden="true">
                        <i class="icofont-long-arrow-left"></i>
                    </span>
                </li>
            @else
                <li class="me-2">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="icofont-long-arrow-left"></i>
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled me-2" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active me-2" aria-current="page">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li class="me-2">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span aria-hidden="true">
                        <i class="icofont-long-arrow-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
