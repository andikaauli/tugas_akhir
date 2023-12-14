@extends('main.main')
@extends('petugas.sirkulasi.sidebar')
@section('active-mulai-sirkulasi', 'bg-white bg-opacity-30')
@section('active-sirkulasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18 mb-4">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Sirkulasi
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
    <div class="justify-center items-center">
     {{-- Section 2 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.loan-start') }}" method="GET">
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
        <div class="flex mb-4 ">
            <table class="table-auto w-full">
               <thead class="p-3 border-y border-solid border-gray-400">
                  <tr class="text-sm">
                     <th class="text-left p-3">NO</th>
                     <th class="text-left p-3">NAMA ANGGOTA</th>
                     <th class="text-left p-3">INSTITUSI</th>
                     <th class="text-left p-3">ID ANGGOTA</th>
                     <th class="text-left p-3">PEMINJAMAN</th>
                  </tr>
               </thead>
               @php
                   $nomor = 1 + ($members->currentPage() - 1) * $members->perPage();
               @endphp
               <tbody>
                   @foreach ($members as $member)
                  <tr class="border-b border-solid border-gray-400">
                     <td class="p-3 leading-6 w-10">{{$nomor++}}</td>
                     <td class="p-3 leading-6">{{$member->name}}</td>
                     <td class="p-3 leading-6 w-42">{{$member->institution}}</td>
                     <td class="p-3 leading-6 w-36">{{$member->nim}}</td>
                     <td class="p-3 leading-6 w-36">
                        <a href="{{ route('client.loan', encrypt($member->id)) }}" class="text-xs text-white font-bold bg-blue-600 hover:bg-blue-500 p-1.5 rounded">Mulai Transaksi</a>
                    </td>
                  </tr>
                 @endforeach
                 @if ($members->isEmpty())
                 <tr>
                   <td class="pt-6 pb-6 text-center border-b border-gray-400 text-red-600 font-semibold" colspan="5">Tidak Ada Data</td>
                 </tr>
                 @endif
               </tbody>
            </table>
        </div>
        <div class="flex justify-end">
            {{$members->withQueryString()->render('pagination.custom')}}
        </div>
    </div>
    </div>
</div>
