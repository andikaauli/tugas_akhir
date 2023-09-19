@extends('main.main')
@extends('petugas.sirkulasi.sidebar')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Sejarah Peminjaman
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     <div class="p-4 bg-blue-100">
        <p>Filter Laporan</p>
     </div>
     <div class="justify-center items-center">
        {{-- Search Bar --}}
       <div class="p-4">
        <p class="mr-3 mb-2 font-normal">Judul/ISBN</p>
        <input type="search" class="relative w-80 m-0 mr-1 mb-3 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300" placeholder="" aria-label="Search" aria-describedby="button-addon3"/>
        {{-- Btn Filter --}}
        <button class="px-3 h-10 rounded text-white text-sm font-semibold bg-blue-600 hover:bg-blue-500">
            Terapkan Filter
         </button>
         {{-- End Btn Filter --}}
        </div>
        {{-- End Search Bar --}}
    </div>
    {{-- Section 2 --}}
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
              <tr class="border-b border-solid border-gray-400">
                 <td class="p-1.5 text-sm leading-6 border-x border-b w-36">B00012</td>
                 <td class="p-1.5 text-sm leading-6 border-r border-b">PostgreSQL : a comprehensive guide to building, programming, and administering PostgreSQL databases</td>
                 <td class="p-1.5 text-sm leading-6 border-r border-b w-32">006.7/86 22</td>
                 <td class="p-1.5 text-sm leading-6 border-r border-b w-32">Reference</td>
                 <td class="p-1.5 text-sm leading-6 border-r border-b w-40">364.1323 Huf p</td>
              </tr>
           </tbody>
        </table>
    </div>
    {{-- End Section 2 --}}
    </div>
</div>
