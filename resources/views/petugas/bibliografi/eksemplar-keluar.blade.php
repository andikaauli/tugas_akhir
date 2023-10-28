@extends('main.main')
@extends('petugas.bibliografi.sidebar')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Daftar Eksemplar Keluar
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center ">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.eksemplar') }}" method="GET">
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
        {{-- End Search Bar --}}
    </div>
    {{-- End Section 2 --}}
       {{-- Section 3 --}}
       <form action="{{ route('client.loan-history') }}">
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
                     <th class="text-left px-1.5 py-4 border-y border-r border-solid border-gray-300">Status Peminjaman</th>
                  </tr>
               </thead>
               @foreach ($loan as $loan)
               <tbody>
                  <tr class="border-b border-solid border-gray-400">
                     <td class="p-1.5 text-sm leading-6 border-x border-b w-24">{{$loan->member->nim}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$loan->member->name}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{$loan->eksemplar->item_code}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b">{{$loan->eksemplar->biblio->title}}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{ Carbon\Carbon::parse($loan->due_date)->format('Y-m-d') }}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-32">{{ Carbon\Carbon::parse($loan->return_date)->format('Y-m-d') }}</td>
                     <td class="p-1.5 text-sm leading-6 border-r border-b w-40">{{$loan->loan_status}}</td>
                  </tr>
               </tbody>
               @endforeach
            </table>
        </div>
    </form>
       {{-- End Section 3 --}}
    </div>
</div>
