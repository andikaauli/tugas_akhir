@extends('main.main')
@extends('petugas.bibliografi.sidebar')
@section('active-bibliografi', 'bg-white bg-opacity-30')
@section('active-bibliografi-navbar', 'text-blue-500 border-blue-500')
{{-- @dd($bibliografi) --}}
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
        {{-- Success meesage --}}
        @if (session('success'))
        <div id="session" class="py-3 px-4 bg-blue-100">
            <div class="p-4 bg-green-500">
                <p class="text-white">{{ session('success') }}</p>
            </div>
        </div>
        @endif
        {{-- End Succes message --}}
        {{-- Section 2 --}}
        <form action="{{ route('client.edit-bibliografi', ['id' => $bibliografi->id]) }}" method="POST" class="h-full"
            enctype="multipart/form-data">
            {{-- @dd($bibliografi) --}}
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
                        id="" cols="30" rows="2">{{ $bibliografi->title }}</textarea>
                    @error('title')
                        <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                            {{ $message }}</p>
                    @enderror
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
                <div class="flex items-center px-4 py-3">
                    <div class="" style="width:200px;">
                        <select name="author_id" required
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
                    <div class="ml-4">
                        @error('author_id')
                            <p class="flex items-center text-red-500 text-sm font-semibold animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
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
                    <input type="text" name="responsibility" id="small-input"
                        value="{{ $bibliografi->responsibility }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('responsibility')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="edition" id="small-input" value="{{ $bibliografi->edition }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('edition')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <textarea type="text" name="spec_detail"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        id="" cols="30" rows="2">{{ $bibliografi->spec_detail }}</textarea>
                        @error('spec_detail')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <a type="button" href="#"
                        class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2  show-modal">Tambah
                        Eksemplar</a>
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
                    <div class="flex-auto max-h-24 border border-gray-400 rounded px-3 py-2 overflow-auto">
                        @if ($bibliografi->eksemplar)
                        @foreach ($bibliografi->eksemplar as $eksemplar)
                            <div class="flex flex-row border-b border-gray-200">
                                <div class="basis-1/2 p-2">
                                    <p class="text-sm font-medium">{{ $eksemplar->item_code }}</p>
                                </div>
                                <div class="basis-1/2 p-2">
                                    <p class="text-sm font-medium">{{ $bibliografi->colltype->title }}</p>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p class="py-2 text-center 300 text-red-600 font-semibold">Tidak Ada Data</p>
                        @endif
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
                    <input type="text" name="gmd" id="small-input" value="{{ $bibliografi->gmd }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('gmd')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="content_type" id="small-input" value="{{ $bibliografi->content_type }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('content_type')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="media_type" id="small-input" value="{{ $bibliografi->media_type }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('media_type')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="carrier_type" id="small-input"
                        value="{{ $bibliografi->carrier_type }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('carrier_type')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="isbnissn" id="small-input" value="{{ $bibliografi->isbnissn }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('isbnissn')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                        <select name="publisher_id"
                            class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 inline-flex items-center">
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ $bibliografi->publisher_id == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->title }}

                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- End Penerbit --}}
            {{-- Tipe Koleksi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tipe Koleksi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="flex flex-auto items-stretch px-4 py-3">
                    <div class="" style="width:200px;">
                        <select name="coll_type_id"
                            class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 inline-flex items-center">
                            @foreach ($colltypes as $colltype)
                                <option value="{{ $colltype->id }}"
                                    {{ $bibliografi->coll_type_id == $colltype->id ? 'selected' : '' }}>
                                    {{ $colltype->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('coll_type_id')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- End Tipe Koleksi --}}
            {{-- Tempat Terbit --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p>Tempat Terbit</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p>:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" name="place" id="small-input" value="{{ $bibliografi->place }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('place')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="description" id="small-input"
                        value="{{ $bibliografi->description }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('description')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <textarea type="text" name="title_series"
                        class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        name="" id="" value="{{ $bibliografi->title_series }}" cols="30" rows="1"></textarea>
                        @error('title_series')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="classification" id="small-input"
                        value="{{ $bibliografi->classification }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('classification')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="call_number" id="small-input"
                        value="{{ $bibliografi->call_number }}" 
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('call_number')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                    <input type="text" name="language" id="small-input" value="{{ $bibliografi->language }}"
                        class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('language')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                        name="abstract" id="" cols="30" rows="2">{{ $bibliografi->abstract }}</textarea>
                        @error('abstract')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                        <img id="blah" src="{{ $bibliografi->image }}" class="rounded-md w-32 h-44"></img>
                        <div class="ml-3">
                            <label class="file">
                                <input class=" border rounded text-sm" type="file" name="image"
                                    accept="image/png, image/jpg, image/jpeg" onchange="readURL(this);">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                        @error('image')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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

@include('petugas.bibliografi.create-eksemplar')

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
    const modal = document.querySelector('.modal');
    const showModal = document.querySelector('.show-modal');
    const closeModal = document.querySelectorAll('.close-modal');

    showModal.addEventListener('click', function() {
        modal.classList.remove('hidden')
    });

    closeModal.forEach(close => {
        close.addEventListener('click', function() {
            modal.classList.add('hidden')
        });
    });
</script>

<script>
    setTimeout(() => {
        const box = document.getElementById('session');
        box.style.display = 'none';
    }, 3000);
</script>
