@if ($paginator->hasPages())
<ul class="pager">
    <div class="flex">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span></span></li>
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
                        <li class="active my-active "><span></span></li>
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
            <li class="disabled"><span class="text-white text-center font-extrabold hover:bg-blue-500">Berikutnya</span></li>
        @endif
    </div>
</ul>
@endif
