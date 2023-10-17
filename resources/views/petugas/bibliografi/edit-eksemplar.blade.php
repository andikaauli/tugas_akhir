@extends('main.main')
@extends('petugas.bibliografi.sidebar')

{{-- Content --}}
<div class="sm:ml-64">
    <div class="mt-18">
        {{-- Section 1 --}}
        <div class="px-4 pt-4 flex my-5">
            <div class="flex items-center">
                <p class="text-3xl text-black font-bold">
                    Eksemplar
                </p>
            </div>
        </div>
        {{-- End Section 1 --}}
        {{-- Section 2 --}}
        <form action="{{ route('client.edit-eksemplar', ['id' => $eksemplar->id]) }}" method="POST" class="h-full">
            @method('PUT')
            @csrf
            <div class="h-full">
                <div class="">
                    {{-- Judul --}}
                    <div class="flex border-y border-solid border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Judul*</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="flex flex-auto items-stretch px-4 py-3">
                            <p class="text-sm font-medium">PostgreSQL : a comprehensive guide to building, programming,
                                and administering PostgreSQL databases</p>
                        </div>
                    </div>
                    {{-- End Judul --}}
                    {{-- Kode RFID --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Kode RFID</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $eksemplar->rfid_code }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Kode RFID --}}
                    {{-- Kode Eksemplar --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Kode Eksemplar</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $eksemplar->item_code }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Kode Eksemplar --}}
                    {{-- No. Panggil --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">No. Panggil</p>
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
                    {{-- Status --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Status</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <div class="" style="width:200px;">
                                <select
                                    class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 items-center">
                                    <option value="0">Status Eksemplar</option>
                                    <option value="1">Audi</option>
                                    <option value="2">BMW</option>
                                    <option value="3">Citroen</option>
                                    <option value="4">Ford</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- End Status --}}
                    {{-- No. Pemesanan --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">No. Pemesanan</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $eksemplar->order_number }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End No. Pemesanan --}}
                    {{-- Tanggal Pemesanan --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Tanggal Pemesanan</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input
                                class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                                type="date" name="dateofbirth" id="dateofbirth" value="{{ $eksemplar->order_date }}">

                            {{ Carbon\Carbon::parse($eksemplar->created_at)->format('Y-m-d') }}

                        </div>
                    </div>
                    {{-- End Tanggal Pemesanan --}}
                    {{-- Tanggal Penerimaan --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Tanggal Penerimaan</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input
                                class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                                type="date" name="dateofbirth" id="dateofbirth">
                        </div>
                    </div>
                    {{-- End Tanggal Penerimaan --}}
                    {{-- Agen --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Agen</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Agen --}}
                    {{-- Sumber Perolehan --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Sumber Perolehan</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="flex text-sm px-4 py-3">
                            <div class="flex items-center justify-center">
                                <input class="mr-2" type="radio" name="" id=""
                                    {{ $eksemplar->source == 'Beli' ? 'checked' : '' }}>
                                <label class="mr-3" for="">Beli</label>
                                <input class="mr-2" type="radio" name="" id=""
                                    @if ($eksemplar->source == 'Hadiah') checked @endif>
                                <label for="">Hadiah/Hibah</label>
                            </div>
                        </div>
                    </div>
                    {{-- End Sumber Perolehan --}}
                    {{-- Faktur --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Faktur</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $eksemplar->invoice }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Faktur --}}
                    {{-- Harga --}}
                    <div class="flex border-b border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Harga</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $eksemplar->price }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Harga --}}
                </div>


                {{-- Btn Simpan --}}
                <div class="flex border-b border-solid border-gray-300 px-4 py-3">
                    <a href="{{ route('client.eksemplar') }}"
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
