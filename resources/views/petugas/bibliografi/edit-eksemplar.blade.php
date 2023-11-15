@extends('main.main')
@extends('petugas.bibliografi.sidebar')
@section('active-eksemplar', 'bg-white bg-opacity-30')
@section('active-bibliografi-navbar', 'text-blue-500 border-blue-500')

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
            @csrf {{ csrf_field() }}
            <div class="h-full">
                <div class="">
                    {{-- Judul --}}
                    <div class="flex border-y border-solid border-gray-300">
                        <div class="px-4 py-3 text-sm w-44">
                            <p class="font-bold text-sm">Judul</p>
                        </div>
                        <div class="px-4 py-3 text-sm">
                            <p>:</p>
                        </div>
                        <div class="flex flex-auto items-stretch px-4 py-3">
                            {{-- @dd($eksemplar) --}}
                            <p class="text-sm font-medium">{{ $eksemplar->biblio->title }}</p>
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
                        <div class="flex modal2">
                            <div class="px-4 py-3">
                                <input name="rfid_code" type="text" id="rfid-input"
                                    value="{{ $eksemplar->rfid_code }}"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-red-600 focus:ring focus:ring-blue-300" readonly>
                            </div>
                            <div class="py-3 items-center">
                                <button type="button"
                                    class="bg-red-600 hover:bg-red-500 px-2 py-1 text-sm text-white font-semibold rounded-sm show-modal">Scan
                                    RFID</button>
                            </div>
                        </div>
                        <div class="modal hidden">
                            <div class="px-4 py-3">
                                <input name="rfid_code" type="text" id="rfid-input"
                                    value="{{ $eksemplar->rfid_code }}"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-blue-600 focus:ring focus:ring-blue-300" readonly>
                            </div>
                            <div class="py-3 items-center">
                                <button type="button"
                                    class="bg-blue-600 hover:bg-blue-500 px-2 py-1 text-sm text-white font-semibold rounded-sm close-modal">Stop
                                    Scan RFID</button>
                            </div>
                        </div>
                        @error('rfid_code')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input name="item_code" type="text" id="item-code-input"
                                value="{{ $eksemplar->item_code }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('item_code')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    {{-- End Kode Eksemplar --}}
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
                                <select name="book_status_id"
                                    class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 items-center">
                                    @foreach ($status as $option)
                                        <option value="{{ $option->id }}"
                                            {{ $eksemplar->book_status_id == $option->id ? 'selected' : '' }}>
                                            {{ $option->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_status_id')
                                    <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                                @enderror
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
                            <input name="order_number" type="text" id="small-input"
                                value="{{ $eksemplar->order_number }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('order_number')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                                type="date" name="order_date" id="dateofbirth" value="{{ $eksemplar->order_date }}">
                        @error('order_date')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror

                            {{-- {{ Carbon\Carbon::parse($eksemplar->created_at)->format('Y-m-d') }} --}}

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
                                type="date" name="recipt_date" id="dateofbirth"
                                value="{{ $eksemplar->receipt_date }}">
                        @error('recipt_date')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input name="agent" type="text" id="small-input" value="{{ $eksemplar->agent }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('agent')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                                <input class="mr-2" type="radio" name="source" id="" value="Beli"
                                    {{ $eksemplar->source == 'Beli' ? 'checked' : '' }}>
                                <label class="mr-3" for="">Beli</label>
                                <input class="mr-2" type="radio" name="source" id="" value="Hadiah"
                                    @if ($eksemplar->source == 'Hadiah') checked @endif>
                                <label for="">Hadiah/Hibah</label>
                            </div>
                        @error('source')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input name="invoice" type="text" id="small-input" value="{{ $eksemplar->invoice }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('invoice')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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
                            <input name="price" type="text" id="small-input" value="{{ $eksemplar->price }}"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        @error('price')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">{{ $message }}</p>
                        @enderror
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

{{-- <script>
    const showModal = document.querySelector('.start-scan');
    let getRfidCode
    showModal.addEventListener('click', function() {
        getRfidCode = setInterval(() => {
            fetch(@json(route('get.rfidtemp')))
                .then(res => res.json())
                .then(data => {
                    if (data.rfid_code) {
                        document.getElementById('rfid-input').value = data.rfid_code
                        clearInterval(getRfidCode)
                    }
                })
        }, 1000);
    });
</script> --}}

<script>
    const modal = document.querySelector('.modal');
    const modal2 = document.querySelector('.modal2');
    const showModal = document.querySelector('.show-modal');
    const closeModal = document.querySelectorAll('.close-modal');
    let getRfidCode
    showModal.addEventListener('click', function() {
        modal.classList.remove('hidden')
        modal.classList.add('flex')
        modal2.classList.add('hidden')
        modal2.classList.remove('flex')
        getRfidCode = setInterval(() => {
            fetch(@json(route('get.rfidtemp')))
                .then(res => res.json())
                .then(data => {
                    if (data.rfid_code) {
                        const rfidInput = document.querySelectorAll("#rfid-input");

                        rfidInput.forEach(rfid => {
                            rfid.value = data.rfid_code
                        })
                        // document.getElementById('rfid-input').value = data.rfid_code
                        clearInterval(getRfidCode)
                    }
                })
        }, 1000);
    });

    // closeModal.addEventListener('click', function() {
    //     modal2.classList.remove('hidden')
    //     modal2.classList.add('flex')
    //     modal.classList.remove('flex')
    //     modal.classList.add('hidden')
    closeModal.forEach(close => {
        close.addEventListener('click', function() {
            modal2.classList.remove('hidden')
            modal2.classList.add('flex')
            modal.classList.remove('flex')
            modal.classList.add('hidden')
            clearInterval(getRfidCode)
        });
    });
</script>
