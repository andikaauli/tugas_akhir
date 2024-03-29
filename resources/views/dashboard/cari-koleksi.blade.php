@extends('dashboard.main')
@section('active-cari-koleksi-navbar', 'text-blue-500 active:border-amber-600')

@section('content')
<div class="items-center justify-center pt-32 mb-10">
    <div class="py-4 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center justify-center">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.koleksi') }}" method="GET">
                <div class="flex items-center">
                    <input type="search" name="search"
                        class="w-108 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
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
    <div class="grid gap-10 grid-cols-3 px-20">
        <div class="col-span-2">
            <div class="p-5 bg-teknik border-x border-t border-black rounded-t-md">
                <div class="flex">
                    {{ $bibliografi->withQueryString()->links('pagination.custom') }}
                </div>
            </div>
            <div class="border-x border-b rounded-b-md border-black">
                @if ($bibliografi)
                    @foreach ($bibliografi as $biblio)
                        <a href="{{ route('client.detail', encrypt($biblio->id)) }}"
                            class="flex px-5 py-3 border-b border-gray-400">
                            <img src="{{ $biblio->image }}" class="h-28 w-20 bg-slate-400 mr-4"></img>
                            <div>
                                <p class="text-base font-semibold">{{ $biblio->title }}</p>
                                {{-- <p class="text-base font-semibold text-gray-500">{{$biblio->author->title}}</p> --}}
                                @if (isset($biblio->author->title))
                                    <p class="text-base font-semibold text-gray-500">{{ $biblio->author->title }}</p>
                                @else
                                    <p class="text-base font-semibold text-gray-500">-</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @else
                    <tr>
                        <th class="pt-6 pb-3 text-center" colspan="6">TIDAK ADA DATA</th>
                    </tr>
                @endif
            </div>
        </div>
        <div class="h-fit">
            <div
                class="bg-teknik border-t border-x border-black rounded-t-md py-5 text-xl font-extrabold text-white text-center">
                <p>Informasi</p>
            </div>
            <div class="py-4 px-6 border-b border-x border-black rounded-b-md">
                <p class="font-medium text-lg text-justify">Akses Katalog Publik Daring - Gunakan fasilitas pencarian
                    untuk mempercepat penemuan data katalog
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
