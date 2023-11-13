@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
@section('active-rekaman-inventarisasi', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Hasil Stock Opname
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
        {{-- Section 2 --}}
    <form action="{{ route('client.stockopname', ['id' => $stockopnames->id]) }}">
        <div class="h-full">
                <div class="">
           {{-- Nama Stock Opname --}}
               <div class="flex border-y border-solid border-gray-300">
                   <div class="px-4 py-3 text-sm w-44">
                       <p class="font-medium text-sm">Nama Stock Opname</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                       <p class="text-sm font-medium">{{$stockopnames->name}}</p>
                   </div>
               </div>
           {{-- End Nama Stock Opname --}}
               {{-- Tanggal Mulai --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
                           <p class="font-medium text-sm">Tanggal Mulai</p>
                       </div>
                       <div class="px-4 py-3 text-sm">
                           <p>:</p>
                       </div>
                       <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames->start_date)) }}</p>
                    </div>
                   </div>
               {{-- End Tanggal Mulai --}}
               {{-- Tanggal Selesai --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
                           <p class="font-medium text-sm">Tanggal Selesai</p>
                       </div>
                       <div class="px-4 py-3 text-sm">
                           <p>:</p>
                       </div>
                       <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames->end_date)) }}</p>
                    </div>
                   </div>
               {{-- End Tanggal Selesai --}}
               {{-- Yang Menginisialisasi --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
                           <p class="font-medium text-sm">Yang Menginisialisasi</p>
                       </div>
                       <div class="px-4 py-3 text-sm">
                           <p>:</p>
                       </div>
                       <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{$stockopnames->name_user}}</p>
                    </div>
                   </div>
               {{-- End Yang Menginisialisasi --}}
               {{-- TTotal Eksemplar Dimiliki --}}
               <div class="flex border-b border-gray-300">
                <div class="px-4 py-3 text-sm w-44">
                    <p class="font-medium text-sm">Total Eksemplar Dimiliki</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                 <p class="text-sm font-medium">{{$stockopnames->total_eksemplar}}</p>
             </div>
            </div>
        {{-- End Total Eksemplar Dimiliki --}}
               {{-- Total Eksemplar Terinventarisasi --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
                           <p class="font-medium text-sm">Total Eksemplar yang Diperiksa</p>
                       </div>
                       <div class="px-4 py-3 text-sm">
                           <p>:</p>
                       </div>
                       <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{$stockopnames->total_diperiksa}}</p>
                    </div>
                   </div>
               {{-- End Total Eksemplar Terinventarisasi --}}
               {{-- Total Eksemplar Hilang --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
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
               {{-- Total Eksmplar Tersedia --}}
                <div class="flex border-b border-gray-300">
                    <div class="px-4 py-3 text-sm w-44">
                        <p class="font-medium text-sm">Total Eksmplar Tersedia</p>
                    </div>
                    <div class="px-4 py-3 text-sm">
                        <p>:</p>
                    </div>
                    <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{$stockopnames->total_tersedia}}</p>
                    </div>
                </div>
                {{-- End Total Eksmplar Tersedia --}}
               {{-- Total Eksemplar Terpinjam --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
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
                <div class="flex border-b border-gray-300">
                    <div class="px-4 py-3 text-sm w-44">
                        <p class="font-medium text-sm">Progres Eksemplar Terpindai</p>
                    </div>
                    <div class="px-4 py-3 text-sm">
                        <p>:</p>
                    </div>
                    <div class="flexitems-stretch px-4 py-3">
                        @php
                            $num = $stockopnames->total_persen;
                            $formattedNum = number_format($num);
                        @endphp
                        <p class="text-sm font-medium">{{$formattedNum}}% / 100%</p>
                    </div>
                </div>
            {{-- End Progres Eksemplar Terpindai --}}

               {{-- Status --}}
                   <div class="flex border-b border-gray-300">
                       <div class="px-4 py-3 text-sm w-44">
                           <p class="font-medium text-sm">Status</p>
                       </div>
                       <div class="px-4 py-3 text-sm">
                           <p>:</p>
                       </div>
                       <div class="flex flex-auto items-stretch px-4 py-3">
                        <p class="text-sm font-medium">{{$stockopnames->status_stockopname}}</p>
                    </div>
                   </div>
               {{-- End Status --}}
               </div>
        </div>
    </form>
   {{-- End Section 2 --}}
    </div>
</div>
