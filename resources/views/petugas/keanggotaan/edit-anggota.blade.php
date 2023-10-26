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
    <form action="{{ route('client.edit-member', ['id' => $members->id]) }}" method="POST" class="m-0 p-0">
        @method('PUT')
        @csrf
        <div class="bg-white">
         {{-- Nama Anggota --}}
             <div class="flex border-b border-solid border-gray-300">
                 <div class="px-4 py-3 text-sm w-60">
                     <p class="font-bold text-sm">Nama Anggota*</p>
                 </div>
                 <div class="px-4 py-3 text-sm">
                     <p class="font-bold text-sm">:</p>
                 </div>
                 <div class="flex items-center">
                     <div class="px-4 py-3 items-stretch flex-auto">
                         <input type="text" id="small-input" value="{{ $members->name}}" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                    <div>
                    @error('name')
                         <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                    @enderror
                    </div>
                 </div>
             </div>
         {{-- End Nama Anggota --}}
         {{-- NIM Anggota --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">NIM Anggota</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="flex items-center">
                    <div class="px-4 py-3">
                        <input value="{{ $members->nim}}" type="text" id="small-input" name="nim" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                    <div>
                        @error('nim')
                                <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        {{-- End NIM Anggota --}}
         {{-- Tanggal Lahir --}}
             <div class="flex border-b border-solid border-gray-300">
                 <div class="px-4 py-3 text-sm w-60">
                     <p class="font-bold text-sm">Tanggal Lahir</p>
                 </div>
                 <div class="px-4 py-3 text-sm">
                     <p class="font-bold text-sm">:</p>
                 </div>
                 <div class="px-4 py-3">
                     <input class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                     type="date" id="dateofbirth" value="{{ Carbon\Carbon::parse($members->birth_date)->format('Y-m-d') }}">
                     {{ Carbon\Carbon::parse($members->created_at)->format('Y-m-d') }}
                 </div>
             </div>
         {{-- End Tanggal Lahir --}}
         {{-- Institusi --}}
             <div class="flex border-b border-solid border-gray-300">
                 <div class="px-4 py-3 text-sm w-60">
                     <p class="font-bold text-sm">Institusi</p>
                 </div>
                 <div class="px-4 py-3 text-sm">
                     <p class="font-bold text-sm">:</p>
                 </div>
                 <div class="px-4 py-3 items-stretch flex-auto">
                     <div class="flex flex-auto items-stretch">
                         <input  value="{{ $members->institution}}" type="text" id="small-input" class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                     </div>
                 </div>
             </div>
         {{-- End Institusi --}}
         {{-- Jenis Kelamin --}}
         <div class="flex border-b border-solid border-gray-300">
             <div class="px-4 py-3 text-sm w-60">
                 <p class="font-bold text-sm">Jenis Kelamin</p>
             </div>
             <div class="px-4 py-3 text-sm">
                 <p class="font-bold text-sm">:</p>
             </div>
             <div class="flex text-sm px-4 py-3">
                 <div class="flex items-center justify-center">
                     <input class="mr-2" type="radio" name="" id=""
                        {{ $members->gender == 'Laki-laki' ? 'checked' : '' }}>
                     <label class="mr-3" for="">Laki-Laki</label>
                     <input class="mr-2" type="radio" name="" id=""
                        @if ($members->gender == 'Perempuan') checked @endif>
                     <label for="">Perempuan</label>
                 </div>
             </div>
         </div>
         {{-- End Jenis Kelamin --}}
         {{-- Alamat --}}
         <div class="flex border-b border-solid border-gray-300">
             <div class="px-4 py-3 text-sm w-60">
                 <p class="font-bold text-sm">Alamat</p>
             </div>
             <div class="px-4 py-3 text-sm">
                 <p class="font-bold text-sm">:</p>
             </div>
             <div class="flex flex-auto items-stretch px-4 py-3">
                 <textarea type="text"  class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" name="" id="" cols="30" rows="2">{{ $members->address}}</textarea>
             </div>
         </div>
         {{-- End Alamat --}}
         {{-- Nomor Telepon --}}
         <div class="flex border-b border-solid border-gray-300">
             <div class="px-4 py-3 text-sm w-60">
                 <p class="font-bold text-sm">Nomor Telepon</p>
             </div>
             <div class="px-4 py-3 text-sm">
                 <p class="font-bold text-sm">:</p>
             </div>
             <div class="px-4 py-3">
                 <input value="{{ $members->phone}}" type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
             </div>
         </div>
         {{-- End Nomor Telepon --}}
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
                     <img src="{{ $members->image}}" class="bg-gray-300 rounded-md w-32 h-32"></img>
                     <div class="ml-3">
                        <label class="file">
                            <input value="{{ $members->image}}" class=" border rounded text-sm" type="file" name="image"
                                onchange="readURL(this);">
                            <span class="file-custom"></span>
                        </label>
                     </div>
                 </div>
             </div>
         </div>
         {{-- End Foto --}}
         {{-- Surel --}}
         <div class="flex border-b border-solid border-gray-300">
             <div class="px-4 py-3 text-sm w-60">
                 <p class="font-bold text-sm">Surel</p>
             </div>
             <div class="px-4 py-3 text-sm">
                 <p class="font-bold text-sm">:</p>
             </div>
             <div class="px-4 py-3">
                 <input value="{{ $members->email}}" type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
             </div>
         </div>
         {{-- End Surel --}}
         {{-- Btn Simpan --}}
         <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <a href="{{ route('client.member') }}"
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
