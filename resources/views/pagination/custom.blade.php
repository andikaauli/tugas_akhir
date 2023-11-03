@if ($paginator->hasPages())
<ul class="pager">
    <div class="flex">
        {{-- First Page --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled hidden" aria-disabled="true" aria-label="@lang('pagination.first')">
            <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
        @else
        <li class="page-item flex">
            <a class="page-link bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ \Request::url() }}" rel="prev" aria-label="@lang('pagination.first')">
                <span class="text-white text-center font-extrabold">Hal. Awal</span>
            </a>
        </li>
        @endif
        {{-- End First Page --}}
        {{-- Btn Previous --}}
        @if ($paginator->onFirstPage())
            <link class="disabled"><span></span></link>
        @else
            <li class="flex">
                <a class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <span class="text-white text-center font-extrabold">Sebelumnya</span>
                </a>
            </li>
        @endif
        {{-- End Btn Previous --}}
        {{-- Btn Number --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled font-extrabold w-4 py-2 mr-3 text-center"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active bg-blue-500 rounded-lg w-10 py-2 mr-3 text-center">
                            <span class="text-white font-extrabold">{{ $page }}</span>
                        </li>
                    @else
                        <li class="flex">
                            <a class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ $url }}">
                                <span class="text-white text-center font-extrabold">{{ $page }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- End Btn Number --}}
        {{-- Btn Next --}}
        @if ($paginator->hasMorePages())
            <li class="flex">
                <a class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span class="text-white text-center font-extrabold">Berikutnya</span>
                </a>
            </li>
        @else
            <li class="disabled hidden"><span class="text-white text-center font-extrabold hover:bg-blue-500">Berikutnya</span></li>
        @endif
        {{-- End Btn Next --}}
        {{-- Btn Last Page --}}
        @if ($paginator->hasMorePages())
        <li class="page-item flex">
            <a class="page-link bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ \Request::url().'?page='.$paginator->lastPage() }}" rel="last" aria-label="@lang('pagination.last')">
                <span class="text-white text-center font-extrabold">Hal. Akhir</span>
            </a>
        </li>
        @else
        <li class="page-item disabled hidden" aria-disabled="true" aria-label="@lang('pagination.last')">
            <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
        @endif
        {{-- End Btn Last Page --}}
    </div>
</ul>
@endif

{{-- @if ($paginator->hasPages())
<ul class="pager">
    <div class="flex">
        @if ($paginator->onFirstPage())
            <a class="disabled"><span></span></a>
        @else
            <li class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500"><a class="text-white text-center font-extrabold" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active bg-blue-500 rounded-lg w-10 py-2 mr-3 text-center"><span class="text-white font-extrabold">{{ $page }}</span></li>
                    @else
                        <li class="bg-gray-500 rounded-lg w-10 py-2 mr-3 text-center hover:bg-blue-500"><a class="text-white font-extrabold" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500"><a class="text-white text-center font-extrabold" href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a></li>
        @else
            <li class="disabled hidden"><span class="text-white text-center font-extrabold hover:bg-blue-500">Berikutnya</span></li>
        @endif
    </div>
</ul>
@endif --}}
