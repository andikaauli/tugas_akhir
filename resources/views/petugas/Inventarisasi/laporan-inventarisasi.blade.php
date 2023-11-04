@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
@section('active-laporan-inventarisasi', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Inventarisasi
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
        {{-- Section 2 --}}
        <div class="h-full">
            <div class="">
            {{-- Nama Inventarisasi --}}
           <div class="flex border-y border-solid border-gray-300">
               <div class="px-4 py-3 text-sm w-46">
                   <p class="font-medium text-sm">Nama Inventarisasi</p>
               </div>
               <div class="px-4 py-3 text-sm">
                   <p>:</p>
               </div>
               <div class="flex flex-auto items-stretch px-4 py-3">
                   <p class="text-sm font-medium">{{$stockopnames->name}}</p>
               </div>
           </div>
            {{-- End Nama Inventarisasi --}}
           {{-- Total Eksemplar Terinventarisasi --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Total Eksemplar Terinventarisasi</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">{{$stockopnames->total_tersedia}}</p>
                </div>
               </div>
           {{-- End Total Eksemplar Terinventarisasi --}}
           {{-- Total Eksemplar Hilang --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Total Eksemplar Hilang</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">{{$stockopnames->total_hilang}}</p>
                </div>
               </div>
           {{-- End Total Eksemplar Hilang --}}
           {{-- Total Eksemplar Terpinjam --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Total Eksemplar Terpinjam</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">{{$stockopnames->total_terpinjam}}</p>
                </div>
               </div>
           {{-- End Total Eksemplar Terpinjam --}}
           {{-- Progres Eksemplar Terpindai --}}
               <div class="flex flex-auto items-stretch border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Progres Eksemplar Terpindai</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                    <div class="px-4 py-3 grow">
                        @php
                            $num = $stockopnames->total_persen;
                            $formattedNum = number_format($num);
                        @endphp
                        <p class="text-sm font-medium">{{$formattedNum}}% / 100%</p>
                        <div class="flex mt-1">
                            <div class="bg-blue-600 h-4" style="width:{{$stockopnames->total_persen}}%"></div>
                            @php
                                $total = 100;
                                $perhitungan = $total-$stockopnames->total_persen;
                            @endphp
                            <div class="bg-red-600 h-4" style="width:{{$perhitungan}}%"></div>
                        </div>
                    </div>
               </div>
           {{-- End Progres Eksemplar Terpindai --}}
           {{-- Pelaksana Inventarisasi --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Pelaksana Inventarisasi</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">{{$stockopnames->name_user}}</p>
                </div>
               </div>
           {{-- End Pelaksana Inventarisasi --}}
           {{-- Tanggal Mulai --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-46">
                       <p class="font-medium text-sm">Tanggal Mulai</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames->start_date))->format('l, d M Y H:i') }}</p>
                </div>
               </div>
           {{-- End Tanggal Mulai --}}
           </div>
      </div>
   {{-- End Section 2 --}}
    </div>
</div>
