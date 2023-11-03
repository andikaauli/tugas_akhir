@extends('dashboard.main')
@section('active-layanan-navbar', 'text-blue-500 border-amber-600')

<div class="pt-32">
    {{-- Section 1 --}}
    <div>

    </div>
    {{-- End Section 1 --}}
    {{-- Setion 2 --}}
    <div class="">
        <div class="grid gap-10 grid-cols-3 px-20">
            <div class="col-span-2">
                <div class="bg-teknik py-5 text-xl border-x border-t border-black rounded-t-md font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="px-12 py-10 border-x border-b rounded-b-md border-black">
                    <p class="font-bold text-2xl mb-3">Perpustakaan mennyediakan layanan yang bisa dimanfaatkan oleh anggota peprustakaan, berupa:</p>
                    <p class="font-medium text-xl mb-3">1. Layanan administrasi</p>
                    <p class="font-medium text-xl mb-3">2. Layanan Peminjaman buku</p>
                    <p class="font-medium text-xl mb-3">3. Layanan referensi (rujukan) dan reserve</p>
                    <p class="font-medium text-xl mb-3">4. Layanan koleksi serial</p>
                    <p class="font-medium text-xl mb-3">5. Layanan koleksi khusus</p>
                    <p class="font-medium text-xl mb-3">6. Layanan fotokopi</p>
                    <p class="font-medium text-xl mb-3">7. Layanan akses informasi</p>
                </div>
            </div>
            <div class="h-fit">
                <div class="bg-teknik border-t border-x border-black rounded-t-md py-5 text-xl font-extrabold text-white text-center">
                    <p>Information</p>
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






