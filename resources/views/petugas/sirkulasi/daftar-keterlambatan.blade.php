@extends('main.main')
@section('active-daftar-keterlambatan', 'bg-white bg-opacity-30')
@section('active-sirkulasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

@section('content')
{{-- Content --}}
 <div class="sm:ml-64">
    @include('petugas.sirkulasi.sidebar')
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Daftar Keterlambatan
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.loan-overdue') }}" method="GET">
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
    {{-- Section 2 --}}
    <form action="{{ route('client.loan-overdue') }}">
        <div class="flex mb-4 p-4 bg-white">
            <table class="table-auto w-full">
               <thead class="p-3 ">
                  <tr class="text-sm bg-gray-200">
                     <th class="text-left px-1.5 py-4 border border-solid border-gray-300">ID Anggota</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Nama Anggota</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Kode Eksemplar</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Judul</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Tanggal Pinjam</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Tanggal Kembali</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Batas Kembali</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Keterlambatan</th>
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Denda</th>
                  </tr>
               </thead>
               @foreach ($loans as $loan)
               <tbody>
                  <tr class="border-b border-solid border-gray-400">
                     <td class="p-1.5 text-sm leading-6 border-x border-b w-24">{{$loan->member->nim}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$loan->member->name}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$loan->eksemplar->item_code}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b">{{$loan->eksemplar->biblio->title}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{ Carbon\Carbon::parse($loan->loan_date) }}</td>
                     @if(isset($loan->return_date))
                        <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{ Carbon\Carbon::parse($loan->return_date)}}</td>
                     @else
                        <td class="p-1.5 text-sm leading-6 border-r border-b w-32"> - </td>
                     @endif
                    <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{ Carbon\Carbon::parse($loan->due_date) }}</td>
                    <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$loan->day_overdue}} hari</td>
                    <td class="p-1.5 text-sm leading-6 border-r border-b w-32">Rp. {{$loan->late_charge}}</td>
                  </tr>
               </tbody>
               @endforeach
               @if ($loans->isEmpty())
               <tr>
                   <td class="pt-6 pb-6 text-center border-b border-x border-gray-300 text-red-600 font-semibold" colspan="9">Tidak Ada Data</td>
               </tr>
               @endif
            </table>
        </div>
        <div class="flex justify-end">
            {{$loans->withQueryString()->links('pagination.custom')}}
        </div>
    </form>
    {{-- End Section 2 --}}
    </div>
</div>
@endsection

