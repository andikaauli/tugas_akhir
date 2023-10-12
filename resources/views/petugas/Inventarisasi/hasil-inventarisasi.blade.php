@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
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
               <div class="px-4 py-3 text-sm w-44">
                   <p class="font-medium text-sm">Nama Inventarisasi</p>
               </div>
               <div class="px-4 py-3 text-sm">
                   <p>:</p>
               </div>
               <div class="flex flex-auto items-stretch px-4 py-3">
                   <p class="text-sm font-medium">Kedelapan</p>
               </div>
           </div>
       {{-- End Nama Inventarisasi --}}
           {{-- Tanggal Mulai --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-44">
                       <p class="font-medium text-sm">Tanggal Mulai</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">2023-07-10 16:33:58</p>
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
                    <p class="text-sm font-medium">2023-07-17 12:34:16</p>
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
                    <p class="text-sm font-medium">Admin</p>
                </div>
               </div>
           {{-- End Yang Menginisialisasi --}}
           {{-- Total Eksemplar Terinventarisasi --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-44">
                       <p class="font-medium text-sm">Total Eksemplar Terinventarisasi</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">5</p>
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
                    <p class="text-sm font-medium">0</p>
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
                    <p class="text-sm font-medium">0</p>
                </div>
               </div>
           {{-- End Total Eksmplar Tersedia --}}
           {{-- Status --}}
               <div class="flex border-b border-gray-300">
                   <div class="px-4 py-3 text-sm w-44">
                       <p class="font-medium text-sm">Status</p>
                   </div>
                   <div class="px-4 py-3 text-sm">
                       <p>:</p>
                   </div>
                   <div class="flex flex-auto items-stretch px-4 py-3">
                    <p class="text-sm font-medium">Selesai</p>
                </div>
               </div>
           {{-- End Status --}}
           </div>
      </div>
   {{-- End Section 2 --}}
    </div>
</div>
