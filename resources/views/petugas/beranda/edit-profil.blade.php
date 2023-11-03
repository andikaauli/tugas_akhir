@extends('main.main')
@extends('petugas.beranda.sidebar')
@section('active-edit-profil', 'bg-white bg-opacity-30')
@section('active-beranda-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Administrasi Perpustakaan
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
    {{-- <form action="{{ route('client.edit-profil', '9a77f60f-0538-466e-9382-73eb8bf92dd4') }}" method="POST" class="m-0 p-0">
        @method('PUT')
        @csrf
        @dd($profils) --}}
        <div class="bg-white">
         {{-- Nama Masuk Pengguna --}}
             <div class="flex border-y border-solid border-gray-300">
                 <div class="px-4 py-3 text-sm w-60">
                     <p class="font-bold text-sm">Nama Masuk Pengguna*</p>
                 </div>
                 <div class="px-4 py-3 text-sm">
                     <p class="font-bold text-sm">:</p>
                 </div>
                 <div class="px-4 py-3">
                     <input type="text" name="title" id="small-input" value="" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                 </div>
             </div>
         {{-- End Nama Masuk Pengguna --}}
         {{-- Nama Asli --}}
         <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Nama Asli*</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" name="title" id="small-input" value="" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Nama Asli --}}
        {{-- Surel --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Surel*</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" name="title" id="small-input" value="" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Surel --}}
                 {{-- Foto --}}
                 <div class="flex border-b border-solid border-gray-300">
                    <div class="px-4 py-3 text-sm w-60">
                        <p class="font-bold text-sm">Foto</p>
                    </div>
                    <div class="px-4 py-3 text-sm">
                        <p class="font-bold text-sm">:</p>
                    </div>
                    <div class="px-4 py-3">
                        <div class="flex">
                            <img id="blah" src="/assets/blank.png" class="rounded-md h-36 w-36" ></img>
                            <div class="ml-3">
                               <label class="file">
                                   <input class=" border rounded text-sm" type="file" name="image" accept="image/png, image/jpg, image/jpeg"
                                       onchange="readURL(this);">
                                   <span class="file-custom"></span>
                               </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Foto --}}
        {{-- Kata Sandi Baru --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Kata Sandi Baru*</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" name="title" id="small-input" value="" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Kata Sandi Baru --}}
        {{-- Konfirmasi Kata Sandi Baru --}}
        <div class="flex border-y border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Konfirmasi Kata Sandi Baru*</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" name="title" id="small-input" value="" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Konfirmasi Kata Sandi Baru --}}
         {{-- Btn Simpan --}}
         <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <a href="{{ route('client.visitors-history') }}"
                class="py-2 px-3 mr-2 rounded text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Batal</a>
            <button type="submit"
                class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-400">Perbaharui</button>
        </div>
        {{-- End Btn Simpan --}}
        </div>
    {{-- </form> --}}
    {{-- End Section 2 --}}
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function(e) {
                document.getElementById('blah').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
