@extends('main.main')
@extends('petugas.keanggotaan.sidebar')

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Keanggotaan
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
       <div class="py-8 px-4 mb-4">
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
       <div class="bg-white">
        <div class="flex py-3 px-4">
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Hapus Data Terpilih</button>
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tandai Semua</button>
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Hilangkan Semua Tanda</button>
        </div>
        <div class="flex mb-4">
            <table class="table-auto w-full">
               <thead class="p-3 border-y border-solid border-gray-400">
                  <tr class="text-sm">
                     <th class="text-left p-3">HAPUS</th>
                     <th class="text-left p-3">SUNTING</th>
                     <th class="text-left p-3">ID ANGGOTA</th>
                     <th class="text-left p-3">NAMA ANGGOTA</th>
                     <th class="text-left p-3">TIPE KEANGGOTAAN</th>
                     <th class="text-left p-3">SUREL</th>
                     <th class="text-left p-3">TERAKHIR DIUBAH</th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="border-b border-solid border-gray-400">
                     <td class="p-3 w-16">
                        <div class="flex items-center justify-center">
                           <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4  border-black rounded">
                       </div>
                     </td>
                     <td class="p-3 w-20">
                        <a href="#" class="flex items-center justify-center">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="24" height="24" fill="black"/>
                              <path d="M16 4L14 6L18 10L20 8L16 4ZM12 8L4 16V20H8L16 12L12 8Z" fill="white"/>
                           </svg>
                        </a>
                     </td>
                     <td class="p-3 w-40">12345678</td>
                     <td class="p-3">
                           <div class="flex">
                              <div class="bg-gray-200 w-14 h-14 rounded-md mr-4"></div>
                              <div class="">
                                <div><p>Andika</p></div>
                                <div><p>0851234567</p></div>
                                <div><p>semarang</p></div>
                              </div>
                           </div>
                     </td>
                     <td class="p-3 w-32">Standar</td>
                     <td class="p-3 w-28">andika@gmail.com</td>
                     <td class="p-3 w-46">2023-02-22 19:09:07</td>
                  </tr>
               </tbody>
            </table>
        </div>
       </div>

       {{-- End Section 3 --}}
    </div>
</div>
