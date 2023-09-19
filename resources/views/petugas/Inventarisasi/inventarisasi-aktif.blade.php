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
     {{-- Search Bar --}}
     <div class="p-4 bg-blue-100">
        <p class="mr-3 mb-2 font-normal">Kode Eksemplar</p>
        <div class="flex">
            <input type="search" class="relative w-80 m-0 mr-1 mb-3 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300" placeholder="" aria-label="Search" aria-describedby="button-addon3"/>
        {{-- Btn Filter --}}
        <button class="px-3 h-10 rounded text-white text-sm font-semibold bg-blue-600 hover:bg-blue-500">
            Ubah Status
         </button>
         {{-- End Btn Filter --}}
        </div>
        </div>
        {{-- End Search Bar --}}
     {{-- Section 2 --}}
       <div class="py-8 px-4 ">
        {{-- Search Bar --}}
           <div class="flex items-center ">
              <p class="mr-3">Cari</p>
              <input type="search" class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                 placeholder="Search"
                 aria-label="Search"
                 aria-describedby="button-addon3"/>
              {{-- Btn Search --}}
              <button class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
                 Cari
              </button>
              {{-- End Btn Search --}}
           </div>
        {{-- End Search Bar --}}
       </div>
       {{-- End Section 2 --}}
       {{-- Section 3 --}}
       <div class="flex mb-4 ">
           <table class="table-auto w-full">
              <thead class="p-3 border-y border-solid border-gray-400">
                 <tr class="text-sm">
                    <th class="text-left p-3">KODE EKSEMPLAR</th>
                    <th class="text-left p-3">JUDUL</th>
                    <th class="text-left p-3">TIPE KOLEKSI</th>
                    <th class="text-left p-3">KLASIFIKASI</th>
                    <th class="text-left p-3">STATUS</th>
                 </tr>
              </thead>
              <tbody>
                 <tr class="border-b border-solid border-gray-400">
                    <td class="p-3 leading-6 w-44">B00012</td>
                    <td class="p-3 leading-6">PostgreSQL : a comprehensive guide to building, programming, and administering PostgreSQL </td>
                    <td class="p-3 leading-6 W-46">005.75/85-22 Kor p</td>
                    <td class="p-3 leading-6 w-28">Reference</td>
                    <td class="p-3 leading-6 w-20">Ada</td>
                 </tr>
              </tbody>
           </table>
       </div>
       {{-- End Section 3 --}}
    </div>
</div>
