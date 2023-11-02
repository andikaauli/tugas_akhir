@if ($paginator->hasPages())
<ul class="pager">
    <div class="flex">
        @if ($paginator->onFirstPage())
            <link class="disabled"><span></span></link>
        @else
            <li class="flex">
                <a class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <span class="text-white text-center font-extrabold">Sebelumnya</span>
                </a>
            </li>
        @endif
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
        @if ($paginator->hasMorePages())
            <li class="flex">
                <a class="bg-gray-500 rounded-lg px-4 py-2 mr-3 hover:bg-blue-500" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span class="text-white text-center font-extrabold">Berikutnya</span>
                </a>
            </li>
        @else
            <li class="disabled hidden"><span class="text-white text-center font-extrabold hover:bg-blue-500">Berikutnya</span></li>
        @endif
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
