@if ($paginator->hasPages())
    <ul class="flex m-auto w-1/2 list-reset text-lg" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- Disabled link --}}
            <li class="flex-1 text-center text-gray-600" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="flex-1 text-center">
                <a class="text-theme-darkest link link--light" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                {{-- Disabled link --}}
                <li class="flex-1 text-center text-gray-600" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="bg-theme-darkest text-white rounded flex-1 text-center" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="flex-1 text-center">
                            <a class="text-theme-darkest link link--light" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="flex-1 text-center">
                <a class="text-theme-darkest link link--light" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            {{-- Disabled link --}}
            <li class="flex-1 text-center text-gray-600" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
