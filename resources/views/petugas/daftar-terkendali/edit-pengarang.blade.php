@extends('main.main')
@extends('petugas.daftar-terkendali.sidebar')

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
    {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Pengarang
             </p>
          </div>
       </div>
    {{-- End Section 1 --}}
    {{-- Section 2 --}}
       <div class="bg-white">
        {{-- Nama Pengarang --}}
            <div class="flex border-y border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Nama Pengarang*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
        {{-- End Nama Pengarang --}}
        {{-- Tahun Lahir Pengarang --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Tahun Lahir Pengarang</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
    {{-- End Tahun Lahir Pengarang --}}
        {{-- Btn Simpan --}}
        <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <button class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-500">Perbaharui</button>
        </div>
        {{-- End Btn Simpan --}}
       </div>
    {{-- End Section 2 --}}
    </div>
</div>


