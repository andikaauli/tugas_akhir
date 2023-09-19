@extends('main.main')
@extends('petugas.inventarisasi.sidebar')

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
    {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Memulai Proses Inventariasi
             </p>
          </div>
       </div>
    {{-- End Section 1 --}}
    {{-- Section 2 --}}
       <div class="bg-white">
        {{-- Nama Inventariasi --}}
            <div class="flex border-y border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Nama Inventariasi*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
        {{-- End Nama Inventariasi --}}
        {{-- Tipe Kolekasi --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Tipe Koleksi</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <div class="" style="width:200px;">
                    <select class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 items-center">
                      <option value="0">SEMUA</option>
                      <option value="1">Fiksi</option>
                      <option value="2">Kesehatan</option>
                      <option value="3">Komik</option>
                      <option value="4">Religi</option>
                    </select>
                  </div>
            </div>
        </div>
        {{-- End Tipe Koleksi --}}
        {{-- Klasifikasi --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Klasifikasi</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
    {{-- End Klasifikasi --}}
        {{-- Btn Simpan --}}
        <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <button class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-500">Inisialisasi Inventarisasi</button>
        </div>
        {{-- End Btn Simpan --}}
       </div>
    {{-- End Section 2 --}}
    </div>
</div>


