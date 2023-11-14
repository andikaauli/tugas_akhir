@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
@section('active-eksemplar-hilang', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Eksemplar Hilang Saat Ini
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     <div class="justify-center items-center">
        <div class="py-8 px-4 mb-4">
            {{-- Search Bar --}}
            <div class="flex items-center">
                <p class="mr-3">Cari</p>
                <form class="m-0" action="{{ route('client.gone-stockopname') }}" method="GET">
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
    </div>
    {{-- Section 2 --}}
    <form action="">
        <div class="flex mb-4 p-4 bg-white">
            <table class="table-auto w-full">
               <thead class="p-3 ">
                  <tr class="text-sm bg-gray-200">
                     <th class="text-left px-1.5 py-4 border border-solid border-gray-300">Kode Eksemplar</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Judul</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Klasifikasi</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Tipe Koleksi</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">No. Panggil</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($stockopnames as $data)
                <tr class="border-b border-solid border-gray-400">
                   <td class="p-1.5 text-sm leading-6 border-x border-b w-36">{{$data->eksemplar->item_code}}</td>
                   <td class="p-1.5 text-sm leading-6 border-r border-b">{{$data->eksemplar->biblio->title}}</td>
                   <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$data->eksemplar->biblio->classification}}</td>
                   {{-- <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$data->eksemplar->biblio->colltype->title}}</td> --}}
                   @if(isset($data->eksemplar->biblio->colltype->title))
                        <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$data->eksemplar->biblio->colltype->title}}</td>
                   @else
                        <td class="p-1.5 text-sm leading-6 border-r border-b w-32">-</td>
                   @endif
                   <td class="p-1.5 text-sm leading-6 border-r border-b w-40">{{$data->eksemplar->biblio->call_number}}</td>
                </tr>
                @endforeach
                @if ($stockopnames->isEmpty())
                <tr>
                    <td class="pt-6 pb-6 text-center border-b border-x border-gray-300 text-red-600 font-semibold" colspan="5">Tidak Ada Data</td>
                </tr>
                @endif
               </tbody>
            </table>
        </div>
    </form>
    <div class="flex justify-end">
    {{$stockopnames->withQueryString()->render('pagination.custom')}}
    </div>
    {{-- End Section 2 --}}
    </div>
</div>
