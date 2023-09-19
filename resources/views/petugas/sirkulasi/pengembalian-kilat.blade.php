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
                Pengembalian Kilat
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     <div class="p-4 bg-blue-100">
        <p>Masukan kode eksemplar dengan menggunakan papan kunci</p>
     </div>
     <div class="justify-center items-center">
        {{-- Search Bar --}}
        <div class="flex items-center px-4 py-5">
            <p class="mr-3">ID Eksemplar</p>
            <input type="search" class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
               placeholder="Search"
               aria-label="Search"
               aria-describedby="button-addon3"/>
            {{-- Btn Search --}}
            <button class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
               Kembali
            </button>
            {{-- End Btn Search --}}
         </div>
      {{-- End Search Bar --}}
    </div>
    </div>
</div>
