
    <div class="modal h-screen w-full fixed z-40 left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        {{-- Modal --}}
                {{-- Tambah Eksemplar --}}
                <div class=" bg-white rounded-2xl">

                    <div class="p-3 border-2 rounded-t-2xl border-solid border-gray-300">
                        <div class="flex">
                            {{-- Btn Simpan --}}
                            <div class="m-3">
                                <button class="text-sm py-2 px-3 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold close-modal">Batal</button>
                            </div>
                            {{-- End Btn Simpan --}}
                            {{-- Btn Simpan --}}
                            <div class="my-3">
                                <button class="text-sm py-2 px-3 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold">Simpan</button>
                            </div>
                            {{-- End Btn Simpan --}}
                        </div>
                    <div class="h-96 overflow-auto">
                        {{-- Judul --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Judul</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
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
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            </div>
                        </div>
                        {{-- End Kode RFID --}}
                        {{-- Kode Eksemplar --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Kode Eksemplar</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            </div>
                        </div>
                        {{-- End Kode Eksemplar --}}
                        {{-- No. Panggil --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>No. Panggil</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            </div>
                        </div>
                        {{-- End No. Panggil --}}
                        {{-- Tipe Koleksi --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Tipe Koleksi</p>
                            </div>
                            <div class="px-4 py-3">
                                <div class="" style="width:200px;">
                                    <select
                                        class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 items-center">
                                        <option value="0">Tipe Koleksi</option>
                                        <option value="1">Audi</option>
                                        <option value="2">BMW</option>
                                        <option value="3">Citroen</option>
                                        <option value="4">Ford</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- End Tipe Koleksi --}}
                        {{-- Status --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Status</p>
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
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>No. Pemesanan</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
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
                                    type="date" name="dateofbirth" id="dateofbirth">
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
                                    type="date" name="dateofbirth" id="dateofbirth">
                            </div>
                        </div>
                        {{-- End Tanggal Penerimaan --}}
                        {{-- Agen --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Agen</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
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
                                    <input class="mr-2" type="radio" name="" id="">
                                    <label class="mr-3" for="">Beli</label>
                                    <input class="mr-2" type="radio" name="" id="">
                                    <label for="">Hadiah/Hibah</label>
                                </div>
                            </div>
                        </div>
                        {{-- End Sumber Perolehan --}}
                        {{-- Faktur --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Faktur</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                            </div>
                        </div>
                        {{-- End Faktur --}}
                        {{-- Harga --}}
                        <div class="flex">
                            <div class="px-4 py-3 font-bold text-sm w-44">
                                <p>Harga</p>
                            </div>
                            <div class="px-4 py-3">
                                <input type="text" id="small-input"
                                    class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
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

    <script>
        const modal = document.querySelector('.modal');
        const showModal = document.querySelector('.show-modal');
        const closeModal = document.querySelectorAll('.close-modal');

        showModal.addEventListener('click', function (){
            modal.classList.remove('hidden')
        });

        closeModal.forEach(close => {
            close.addEventListener('click', function (){
                modal.classList.add('hidden')
            });
        });
    </script>
