@extends('main.main')
@extends('petugas.bibliografi.sidebar')

{{-- Content --}}
<div class="sm:ml-64">
    <div class="mt-18">
        {{-- Section 1 --}}
        <div class="px-4 pt-4 flex my-5">
            <div class="flex items-center">
                <p class="text-3xl text-black font-bold">
                    Bibliografi
                </p>
            </div>
        </div>
        {{-- End Section 1 --}}
        {{-- Section 2 --}}
        <form action="{{ route('client.edit-bibliografi', ['id' => $bibliografi->id]) }}" method="POST" class="h-full">
            @method('PUT')
            @csrf
            {{-- Judul --}}
            <div class="flex border-y border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Judul*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <textarea type="text" name="title"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        name="" id="" cols="30" rows="2">{{ $bibliografi->title }}</textarea>
                </div>
            </div>
            {{-- End Judul --}}
            {{-- Pengarang --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Pengarang*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <div class="" style="width:200px;">
                        <select
                            class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 inline-flex items-center">
                            <option value="0">Pilih Pengarang</option>
                            @foreach ($pengarang as $option)
                                <option value="{{ $option->id }}"
                                    {{ $bibliografi->author_id == $option->id ? 'selected' : '' }}>
                                    {{ $option->title }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('author_id')
                        <p class="text-red-500 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- End Pengarang --}}
            {{-- Pernyataan Tanggung Jawab --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Pernyataan Tanggung Jawab</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input" value="{{ $bibliografi->responsibility }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Pernyataan Tanggung Jawab --}}
            {{-- Edisi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Edisi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input" value="{{ $bibliografi->edition }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Edisi --}}
            {{-- Info Detail Spesifik --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Info Detail Spesifik</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <textarea type="text"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        name="" id="" cols="30" rows="2">{{ $bibliografi->spec_detail }}</textarea>
                </div>
            </div>
            {{-- End Info Detal Spesifik --}}
            {{-- Tambah Eksemplar --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tambah Eksemplar</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <button type="button" id="select-all"
                        class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tambah
                        Eksemplar</button>
                </div>
            </div>
            {{-- End Tambah Eksemplar --}}
            {{-- Data Koleksi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Data Koleksi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3 flex-auto">
                    <div class="flex-auto h-24 border border-gray-400 rounded px-3 py-2 overflow-auto">
                        <div class="flex flex-row border-b border-gray-200">
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">B00002</p>
                            </div>
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">Reference</p>
                            </div>
                        </div>
                        <div class="flex flex-row border-b border-gray-200">
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">B00002</p>
                            </div>
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">Reference</p>
                            </div>
                        </div>
                        <div class="flex flex-row border-b border-gray-200">
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">B00002</p>
                            </div>
                            <div class="basis-1/2 p-2">
                                <p class="text-sm font-medium">Reference</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Data Koleksi --}}
            {{-- GMD --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>GMD</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End GMD --}}
            {{-- Tipe Isi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tipe Isi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Tipe Isi --}}
            {{-- Tipe Media --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tipe Media</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Tipe Media --}}
            {{-- Tipe Pembawa --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tipe Pembawa</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Tipe Pembawa --}}
            {{-- ISBN/ISSN --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>ISBN/ISSN</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End ISBN/ISSN --}}
            {{-- Penerbit --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Penerbit</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <div class="" style="width:200px;">
                        <select
                            class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 inline-flex items-center">
                            <option value="0">Penerbit</option>
                            <option value="1">Audi</option>
                            <option value="2">BMW</option>
                            <option value="3">Citroen</option>
                            <option value="4">Ford</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- End Penerbit --}}
            {{-- Tempat Terbit --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tempat Terbit</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Tempat Terbit --}}
            {{-- Deskripsi Fisik --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Deskripsi Fisik</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Deskripsi Fisik --}}
            {{-- Judul Seri --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Judul Seri</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <textarea type="text"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        name="" id="" cols="30" rows="1"></textarea>
                </div>
            </div>
            {{-- End Judul Seri --}}
            {{-- Klasifikasi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Klasifikasi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Klasifikasi --}}
            {{-- No. Panggil --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>No. Panggil</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End No. Panggil --}}
            {{-- Bahasa --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Bahasa</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
            {{-- End Bahasa --}}
            {{-- Abstrak/Catatan --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Abstrak/Catatan</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <textarea type="text"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        name="" id="" cols="30" rows="2">{{ $bibliografi->abstract }}</textarea>
                </div>
            </div>
            {{-- End Abstrak/Catatan --}}
            {{-- Gambar Sampul --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Gambar Sampul</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <div class="flex">
                        <img src="{{ $bibliografi->image }}" class="bg-gray-300 rounded-md w-32 h-44"></img>
                        <div class="ml-3">
                            <label class="file">
                                <input class=" border rounded text-sm" type="file" id="file"
                                    aria-label="File browser example">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Gambar Sampul --}}
            {{-- Btn Simpan --}}
            <div class="flex border-b border-solid border-gray-300 px-4 py-3">
                <a href="{{ route('client.bibliografi') }}"
                    class="py-2 px-3 mr-2 rounded text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Batal</a>
                <button type="submit"
                    class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-400">Perbaharui</button>
            </div>
            {{-- End Btn Simpan --}}
        </form>
        {{-- End Section 2 --}}
    </div>
</div>
