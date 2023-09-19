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
       <div class="bg-white">
        {{-- ID Anggota --}}
            <div class="flex border-y border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">ID Anggota*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
        {{-- End ID Anggota --}}
        {{-- Nama Anggota --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Nama Anggota*</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3 items-stretch flex-auto">
                    <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                </div>
            </div>
        {{-- End Nama Anggota --}}
        {{-- Tanggal Lahir --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Tanggal Lahir</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" type="date" name="dateofbirth" id="dateofbirth">
                </div>
            </div>
        {{-- End Tanggal Lahir --}}
        {{-- Anggota Sejak --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Anggota Sejak</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" type="date" name="dateofbirth" id="dateofbirth">
                </div>
            </div>
        {{-- End Anggota Sejak --}}
        {{-- Tanggal Registrasi --}}
            <div class="flex border-b border-solid border-gray-300">
                <div class="px-4 py-3 text-sm w-60">
                    <p class="font-bold text-sm">Tanggal Registrasi</p>
                </div>
                <div class="px-4 py-3 text-sm">
                    <p class="font-bold text-sm">:</p>
                </div>
                <div class="px-4 py-3">
                    <input class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" type="date" name="dateofbirth" id="dateofbirth">
                </div>
            </div>
        {{-- End Tanggal Registrasi --}}
        {{-- Berlaku Hingga --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Berlaku Hingga</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input class="px-2 py-1.5 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" type="date" name="dateofbirth" id="dateofbirth">
            </div>
        </div>
        {{-- End Berlaku Hingga --}}
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
                        <input type="text" id="small-input" class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
                    </div>
                </div>
            </div>
        {{-- End Institusi --}}
        {{-- Tipe Kanggotaan --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Tipe Kanggotaan</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="flex flex-auto items-stretch px-4 py-3">
                <div class="" style="width:200px;">
                    <select class="w-52 min-w-fit text-black focus:ring focus:ring-blue-300 focus:border-blue-600 font-medium rounded border border-solid border-gray-400 text-sm px-2.5 py-1.5 mr-1 inline-flex items-center">
                      <option value="0">Tipe Kanggotaan</option>
                      <option value="1">Audi</option>
                      <option value="2">BMW</option>
                      <option value="3">Citroen</option>
                      <option value="4">Ford</option>
                    </select>
                  </div>
            </div>
        </div>
        {{-- End Tipe Kanggotaan --}}
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
                    <input class="mr-2" type="radio" name="" id="">
                    <label class="mr-3" for="">Laki-Laki</label>
                    <input class="mr-2" type="radio" name="" id="">
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
                <textarea type="text"  class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" name="" id="" cols="30" rows="2"></textarea>
            </div>
        </div>
        {{-- End Alamat --}}
        {{-- Kode Pos --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Kode Pos</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Kode Pos --}}
        {{-- Alamat Surat --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Alamat Surat</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="flex flex-auto items-stretch px-4 py-3">
                <textarea type="text"  class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" name="" id="" cols="30" rows="2"></textarea>
            </div>
        </div>
        {{-- End Alamat Surat --}}
        {{-- Nomor Telepon --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Nomor Telepon</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Nomor Telepon --}}
        {{-- Nomor Identitas --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Nomor Identitas</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Nomor Identitas --}}
        {{-- Catatan --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Catatan</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="flex flex-auto items-stretch px-4 py-3">
                <textarea type="text"  class="flex-auto py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300" name="" id="" cols="30" rows="2"></textarea>
            </div>
        </div>
        {{-- End Catatan --}}
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
                    <div class="bg-gray-300 rounded-md w-32 h-32"></div>
                    <div class="ml-3">
                        <label class="file">
                            <input class=" border rounded text-sm" type="file" id="file" aria-label="File browser example">
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
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Surel --}}
        {{-- Kata sandi baru --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Kata sandi baru</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Kata sandi baru --}}
        {{-- Konfirmasi kata sandi baru --}}
        <div class="flex border-b border-solid border-gray-300">
            <div class="px-4 py-3 text-sm w-60">
                <p class="font-bold text-sm">Konfirmasi kata sandi baru</p>
            </div>
            <div class="px-4 py-3 text-sm">
                <p class="font-bold text-sm">:</p>
            </div>
            <div class="px-4 py-3">
                <input type="text" id="small-input" class="w-96 py-1 px-2 text-gray-900 border rounded text-sm border-solid border-gray-400 focus:ring focus:ring-blue-300">
            </div>
        </div>
        {{-- End Konfirmasi kata sandi baru --}}
        {{-- Btn Simpan --}}
        <div class="flex border-b border-solid border-gray-300 px-4 py-3">
            <button class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-500">Simpan</button>
        </div>
        {{-- End Btn Simpan --}}
       </div>
    {{-- End Section 2 --}}
    </div>
</div>


