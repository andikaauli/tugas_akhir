@extends('main.main')
@section('active-create-anggota', 'bg-white bg-opacity-30')
@section('active-keanggotaan-navbar', 'text-blue-500 border-blue-500')

@section('content')
{{-- Content --}}
<div class="sm:ml-64">
    @include('petugas.keanggotaan.sidebar')
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
        <form action="{{ route('client.create-member') }}" method="POST" class="m-0 p-0" enctype="multipart/form-data">
            @csrf
            <div class="bg-white">
                {{-- Nama Anggota --}}
                <div class="flex border-y border-solid border-gray-300">
                    <div class="px-4 py-3 text-sm w-60">
                        <p class="font-bold text-sm">Nama Anggota*</p>
                    </div>
                    <div class="px-4 py-3 text-sm">
                        <p class="font-bold text-sm">:</p>
                    </div>
                    <div class="flex items-center">
                        <div class="px-4 py-3 items-stretch flex-auto">
                            <input type="text" name="name" id="small-input"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
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
                        <p class="font-bold text-sm">NIM Anggota*</p>
                    </div>
                    <div class="px-4 py-3 text-sm">
                        <p class="font-bold text-sm">:</p>
                    </div>
                    <div class="flex items-center">
                        <div class="px-4 py-3">
                            <input type="text" name="nim" id="small-input"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
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
                        <input
                            class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                            type="date" name="birth_date" id="dateofbirth">
                        @error('birth_date')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input name="institution" type="text" id="small-input"
                                class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                        @error('institution')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input class="mr-2" type="radio" name="gender" value="Laki-laki" id="">
                            <label class="mr-3" for="">Laki-Laki</label>
                            <input class="mr-2" type="radio" name="gender" value="Perempuan" id="">
                            <label for="">Perempuan</label>
                        </div>
                        @error('gender')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                        <textarea type="text" name="address"
                            class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                            name="" id="" cols="30" rows="2"></textarea>
                    </div>
                    @error('address')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                    @enderror
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
                        <input type="text" name="phone" id="small-input"
                            class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                    @error('phone')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                    @enderror
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
                            <img id="blah" src="/assets/blank.png"
                                class="rounded-md max-w-xxs">
                            <div class="ml-3">
                                <label class="file">
                                    <input class=" border rounded text-sm" type="file" name="image" accept="image/png, image/jpg, image/jpeg"
                                        onchange="readURL(this);">
                                    <span class="file-custom"></span>
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                        <input type="text" name="email" id="small-input"
                            class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                    @error('email')
                            <p class="flex items-center text-red-500 ml-4 text-sm font-semibold animate-pulse">{{ $message }}</p>
                    @enderror
                </div>
                {{-- End Surel --}}
                {{-- Btn Simpan --}}
                <div class="flex border-b border-solid border-gray-300 px-4 py-3">
                    <button type="submit"
                        class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-500">Simpan</button>
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
@endsection

