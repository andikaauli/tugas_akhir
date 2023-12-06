@extends('main.main')
@section('active-bibliografi', 'bg-white bg-opacity-30')
@section('active-bibliografi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}
{{-- Content --}}
@section('content')
    <div class="sm:ml-64">
        @include('petugas.bibliografi.sidebar')
        <div class="mt-18">
            @method('DELETE')
            @csrf
            {{-- Section 1 --}}
            <div class="px-4 pt-4 flex my-5">
                <div class="flex items-center">
                    <p class="text-3xl text-black font-bold">
                        Bibliografi
                    </p>
                </div>
            </div>
            {{-- End Section 1 --}}
            {{-- Success meesage --}}
            @if (session('success'))
                <div id="session" class="py-3 px-4 bg-blue-100">
                    <div class="p-4 bg-green-500">
                        <p class="text-white font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if (session('destroy'))
                <div id="session" class="py-3 px-4 bg-blue-100">
                    <div class="p-4 bg-red-600">
                        <p class="text-white font-semibold">{{ session('destroy') }}</p>
                    </div>
                </div>
            @endif
            {{-- End Succes message --}}
            {{-- Section 2 --}}
            <div class="py-8 px-4 mb-4">
                {{-- Search Bar --}}
                <div class="flex items-center">
                    <p class="mr-3">Cari</p>
                    <form class="m-0" action="{{ route('client.bibliografi') }}" method="GET">
                        <div class="flex items-center">
                            <input type="search" name="search"
                                class="w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                                value="{{ request('search') }}" placeholder="Search" aria-label="Search"
                                aria-describedby="button-addon3" />
                            {{-- Btn Search --}}
                            <button type="submit"
                                class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
                                Cari
                            </button>
                        </div>
                    </form>
                    {{-- End Btn Search --}}
                </div>
            </div>
            {{-- End Section 2 --}}
            {{-- Section 3 --}}
            <form action="{{ route('client.delete-bibliografi') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex mb-4 py-3 px-4">
                    <button type="submit"
                        class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Hapus Data
                        Terpilih</button>
                    <button type="button" id="select-all"
                        class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tandai
                        Semua</button>
                    <button type="button" id="deselect-all"
                        class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Hilangkan Semua
                        Tanda</button>
                </div>
                {{-- End Section 3 --}}
                {{-- Section 4 --}}
                <div class="flex mb-4">

                    <table class="table-auto w-full">
                        <thead class="p-3 border-y border-solid border-gray-400">
                            <tr>
                                <th class="text-left p-3">HAPUS</th>
                                <th class="text-left p-3">SUNTING</th>
                                <th class="text-left p-3">JUDUL</th>
                                <th class="text-left p-3">ISBN/ISSN</th>
                                <th class="text-left p-3">SALIN</th>
                                <th class="text-left p-3">PERUBAHAN TERAKHIR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bibliografi as $biblio)
                                <tr class="border-b border-solid border-gray-400">
                                    <td class="p-3 w-16">
                                        <div class="flex items-center justify-center">
                                            <input id="default-checkbox" type="checkbox" name="deletedBiblio[]"
                                                value="{{ $biblio->id }}" class="w-4 h-4  border-black rounded">
                                        </div>
                                    </td>
                                    <td class="p-3 w-20">
                                        <a href="{{ route('client.edit-bibliografi', ['id' => $biblio->id, 'page' => request('page')]) }}"
                                            class="flex items-center justify-center">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="24" height="24" fill="black" />
                                                <path d="M16 4L14 6L18 10L20 8L16 4ZM12 8L4 16V20H8L16 12L12 8Z"
                                                    fill="white" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex">
                                            <img src="{{ $biblio->image ?? 'assets/blank-book.png' }}" class="w-12 h-16">
                                            <div class="ml-4">
                                                <p class="text-sm font-medium">{{ $biblio->title }}</p>
                                                {{-- <p class="text-sm font-medium text-gray-500">{{$biblio->author->title}}</p> --}}
                                                @if (isset($biblio->author->title))
                                                    <p class="text-sm font-medium text-gray-500">
                                                        {{ $biblio->author->title }}</p>
                                                @else
                                                    <p class="text-sm font-medium text-gray-500">-</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    @if (isset($biblio->isbnissn))
                                        <td class="p-3 w-36">{{ $biblio->isbnissn }}</td>
                                    @else
                                        <td class="p-3 w-36">-</td>
                                    @endif
                                    <td class="p-3 w-16 text-center">{{ count($biblio->eksemplar) }}</td>
                                    <td class="p-3 w-52">
                                        {{ Carbon\Carbon::createFromTimestamp(strtotime($biblio->updated_at)) }}</td>
                                </tr>
                            @endforeach
                            @if ($bibliografi->isEmpty())
                                <tr>
                                    <td class="pt-6 pb-6 text-center border-b border-gray-400 text-red-600 font-semibold"
                                        colspan="6">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end">
                    {{ $bibliografi->withQueryString()->links('pagination.custom') }}
                </div>
                {{-- End Section 4 --}}
            </form>
        </div>
    </div>

    <script>
        const selectAllBtn = document.getElementById('select-all');
        const deselectAllBtn = document.getElementById('deselect-all');

        selectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(check => {
                check.checked = true
            });
        })

        deselectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(check => {
                check.checked = false
            });
        })
    </script>

    <script>
        setTimeout(() => {
            const box = document.getElementById('session');
            box.style.display = 'none';
        }, 3000);
    </script>
@endsection
