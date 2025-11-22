@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-black text-gray-400 bg-white border-2 border-black cursor-default leading-5 uppercase">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-black text-black bg-white border-2 border-black leading-5 uppercase hover:bg-neo-yellow transition duration-150 shadow-neo hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-black text-black bg-white border-2 border-black leading-5 uppercase hover:bg-neo-yellow transition duration-150 shadow-neo hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-black text-gray-400 bg-white border-2 border-black cursor-default leading-5 uppercase">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
