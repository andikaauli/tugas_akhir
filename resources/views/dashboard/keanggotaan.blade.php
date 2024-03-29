@extends('dashboard.main')
@section('active-keanggotaan-navbar', 'text-blue-500 border-amber-600')



@section('content')
<div class="pt-32">
    {{-- Section 1 --}}
    <div>

    </div>
    {{-- End Section 1 --}}
    {{-- Setion 2 --}}
    <div class="mb-10">
        <div class="grid gap-10 grid-cols-3 w- px-20">
            <div class="col-span-2">
                <div class="bg-teknik py-5 text-xl border-x border-t border-black rounded-t-md font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="px-12 py-10 border-x border-b rounded-b-md border-black">
                    <p class="font-bold text-2xl mb-3">Perpustakaan mennyediakan layanan yang bisa dimanfaatkan oleh anggota peprustakaan, berupa:</p>
                    <ol class="list-decimal font-medium text-xl mb-3 ml-5">
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">meminjam buku koleksi sirkulasi, selama 7 hari sebanyak 2 expl, dengan 1 kali masa perpanjangan</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">membaca koleksi referensi, koleksi tandon, koleksi terbitan serial dan koleksi khusus yang dimiliki perpustakaan di tempat yang telah disediakan</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">mendapatkan akses informasi koleksi yang dimiliki perpustakaan</p>
                        </li>
                    </ol>
                    <p class="font-bold text-2xl mb-3">5 Kewajiban anggota</p>
                    <ol class="list-decimal font-medium text-xl mb-3 ml-5">
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">memelihara buku koleksi perpustakaan</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">mengembalikan buku yang dipinjam tepat pada waktunya</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">menjaga ketenangan, kebersihan dan ketertiban perpustakaan</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">mengisi daftar hadir setiap kali berkunjung</p>
                        </li>
                        <li>
                            <p class="font-medium text-xl mb-1 leading-8">menyimpan tas, jaket, binder dan buku di loker yang telah disediakan</p>
                        </li>
                    </ol>
                    <p class="font-bold text-2xl mb-3">Sanksi</p>
                    <ol class="list-decimal font-medium text-xl mb-3 ml-5">
                        <li class="font-medium text-xl mb-1 leading-8">keterlambatan pengembalian buku akan dikenai denda sebesar Rp. 200,-/ buku/hari</li>
                        <li class="font-medium text-xl mb-1 leading-8">buku yang hilang atau rusak harus diganti dengan buku yang sama</li>
                    </ol>
                </div>
            </div>
            <div class="h-fit">
                <div class="bg-teknik border-t border-x border-black rounded-t-md py-5 text-xl font-extrabold text-white text-center">
                    <p>Informasi</p>
                </div>
                <div class="py-4 px-6 border-b border-x border-black rounded-b-md">
                    <p class="font-medium text-lg text-justify">Akses Katalog Publik Daring - Gunakan fasilitas pencarian untuk mempercepat penemuan data katalog
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Section 2 --}}
</div>
@endsection







