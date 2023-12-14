@extends('main.main')
@extends('petugas.daftar-terkendali.sidebar')
@section('active-penerbit', 'bg-white bg-opacity-30')
@section('active-daftarTerkendali-navbar', 'text-blue-500 border-blue-500')

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
    {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Penerbit
             </p>
          </div>
       </div>
    {{-- End Section 1 --}}
    {{-- Section 2 --}}
    <form action="{{ route('client.edit-publishers', encrypt($publisher->id)) }}" method="POST" class="m-0 p-0">
        @method('PUT')
        @csrf
        <div class="bg-white">
         {{-- Nama Penerbit --}}
             <div class="flex border-y border-solid border-gray-300">
                 <div class="px-4 py-3 text-sm w-60">
                     <p class="font-bold text-sm">Nama Penerbit*</p>
                 </div>
                 <div class="px-4 py-3 text-sm">
                     <p class="font-bold text-sm">:</p>
                 </div>
                 <div class="px-4 py-3">
                     <input type="text" name="title" id="small-input" value="{{ $publisher->title}}" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    @error('title')
                        <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                    @enderror
                 </div>
             </div>
         {{-- End Nama Penerbit --}}
         {{-- Btn Simpan --}}
         <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <a href="{{ route('client.publishers') }}"
                class="py-2 px-3 mr-2 rounded text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Batal</a>
            <button type="submit"
                class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-400">Perbaharui</button>
        </div>
        {{-- End Btn Simpan --}}
        </div>
    </form>
    {{-- End Section 2 --}}
    </div>
</div>


