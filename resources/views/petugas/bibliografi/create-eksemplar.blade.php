<form action="{{ route('client.create-eksemplar', ['id' => $bibliografi->id]) }}" method="POST" class="m-0 p-0">
    @csrf
    <div
        class="modal h-screen w-full fixed z-40 left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 {{ $showModal ? 'flex' : 'hidden' }}">
        {{-- Modal --}}
        {{-- Tambah Eksemplar --}}
        <div class=" bg-white rounded-2xl">

            <div class="p-3 border-2 rounded-t-2xl border-solid border-gray-300">
                <div class="flex">
                    {{-- Btn Batal --}}
                    <div class="m-3">
                        <button type="button"
                            class="text-sm py-2 px-3 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold close-modal">Batal</button>
                    </div>
                    {{-- End Btn Batal --}}
                    {{-- Btn Simpan --}}
                    <div class="my-3">
                        <button type="submit"
                            class="text-sm py-2 px-3 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold">Simpan</button>
                    </div>
                    {{-- End Btn Simpan --}}
                </div>
                <div class="h-96 overflow-auto">

                    <input type="hidden" name="biblio_id" value="{{ $bibliografi->id }}">
                    {{-- Judul --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Judul</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" value="{{ $bibliografi->title }}" disabled
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                    {{-- End Judul --}}
                    {{-- Kode RFID --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Kode RFID</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="rfid-input" readonly name="rfid_code"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                        </div>
                        @error('rfid_code')
                            <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    {{-- End Kode RFID --}}
                    {{-- Kode Eksemplar --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Kode Eksemplar</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" name="item_code"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            @error('item_code')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Kode Eksemplar --}}
                    {{-- No. Panggil --}}
                    {{-- <div class="flex">
                    <div class="px-4 py-3 font-bold text-sm w-44">
                        <p>No. Panggil</p>
                    </div>
                    <div class="px-4 py-3">
                        <input type="text" id="small-input" name=""
                            class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                </div> --}}
                    {{-- End No. Panggil --}}
                    {{-- Status --}}
                    <div class="hidden">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Status</p>
                        </div>
                        <div class="px-4 py-3">
                            <div class="" style="width:200px;">
                                <select name="book_status_id"
                                    class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 items-center">
                                    @foreach ($statuses as $status)
                                        <option value="2">
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- End Status --}}
                    {{-- No. Pemesanan --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>No. Pemesanan</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" name="order_number"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            @error('order_number')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End No. Pemesanan --}}
                    {{-- Tanggal Pemesanan --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Tanggal Pemesanan</p>
                        </div>
                        <div class="px-4 py-3">
                            <input
                                class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                                type="date" name="order_date" id="dateofbirth">
                            @error('order_date')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Tanggal Pemesanan --}}
                    {{-- Tanggal Penerimaan --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Tanggal Penerimaan</p>
                        </div>
                        <div class="px-4 py-3">
                            <input
                                class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300"
                                type="date" name="receipt_date" id="dateofbirth">
                            @error('receipt_date')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Tanggal Penerimaan --}}
                    {{-- Agen --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Agen</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" name="agent"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            @error('agent')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Agen --}}
                    {{-- Sumber Perolehan --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Sumber Perolehan</p>
                        </div>
                        <div class="flex text-sm px-4 py-3">
                            <div class="flex items-center justify-center">
                                <input class="mr-2" type="radio" name="source" value="Beli" id="">
                                <label class="mr-3" for="">Beli</label>
                                <input class="mr-2" type="radio" name="source" value="Hadiah" id="">
                                <label for="">Hadiah/Hibah</label>
                            </div>
                            @error('source')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Sumber Perolehan --}}
                    {{-- Faktur --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Faktur</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" name="invoice"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            @error('invoice')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Faktur --}}
                    {{-- Harga --}}
                    <div class="flex">
                        <div class="px-4 py-3 font-bold text-sm w-44">
                            <p>Harga</p>
                        </div>
                        <div class="px-4 py-3">
                            <input type="text" id="small-input" name="price"
                                class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            @error('price')
                                <p class="flex items-center text-red-500 ml-3 text-sm font-semibold animate-pulse">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- End Harga --}}
                </div>


            </div>
            {{-- Footer --}}
            <div class="bg-black p-6 rounded-b-2xl border border-black">
                <p class="text-white text-center font-bold text-sm">Eksemplar/Kopi</p>
            </div>
            {{-- End Footer --}}
        </div>
        {{-- End Tambah Eksemplar --}}
    </div>
</form>

<script>
    const modal = document.querySelector('.modal');
    const showModal = document.querySelector('.show-modal');
    const closeModal = document.querySelectorAll('.close-modal');
    let getRfidCode
    showModal.addEventListener('click', function() {
        modal.classList.remove('hidden')
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

    closeModal.forEach(close => {
        close.addEventListener('click', function() {
            modal.classList.add('hidden')
            clearInterval(getRfidCode)
        });
    });
</script>
