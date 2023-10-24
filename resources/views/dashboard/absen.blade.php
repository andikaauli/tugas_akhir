@extends('dashboard.main')
<div class="flex items-center justify-center pt-32">
    <form action="" method="POST" class="m-0 p-0">
        {{-- Section 1 --}}
        <div class="border-black border">
            <div class="py-6 bg-teknik">
                <p class="text-center text-white text-2xl font-semibold">Penghitung Jumlah Pengunjung</p>
            </div>
            <div class="">
                <div class="p-4">
                    <p class="text-sm font-semibold">Silahkan masukkan nomor anggota Anda atau masukkan nama lengkap Anda</p>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-bold">ID Anggota / Nama Pengunjung</p>
                    </div>
                    <div class="p-3">
                        <input class="w-full rounded-md" type="text">
                    </div>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-bold">Institusi / Nama Pengunjug</p>
                    </div>
                    <div class="p-3">
                        <input class="w-full rounded-md" type="text">
                    </div>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-semibold">ID Anggota / Nama Pengunjung</p>
                    </div>
                    <div class="p-3">
                        <select class="w-full rounded-md text-center">
                            <option value="1">Dosen</option>
                            <option value="1">Dosen</option>
                            <option value="1">Dosen</option>
                            <option value="1">Dosen</option>
                        </select>
                    </div>
                </div>
                <div class="p-3">
                    <button type="submit" class="bg-teknik w-full rounded-md text-white font-bold text-base py-2.5">
                        Tambah
                    </button>
                </div>
            </div>

        </div>
        {{-- End Section 1 --}}
    </form>
</div>
