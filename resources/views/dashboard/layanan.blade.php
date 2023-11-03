@extends('dashboard.main')
@section('active-layanan-navbar', 'text-blue-500 border-amber-600')

<div class="pt-32">
    {{-- Section 1 --}}
    <div>

    </div>
    {{-- End Section 1 --}}
    {{-- Setion 2 --}}
    <div class="">
        <div class="grid gap-10 grid-cols-3 grid-rows-3 px-20">
            <div class="col-span-2 border border-black">
                <div class="bg-teknik py-5 text-xl font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="px-12 py-10">
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
            <div class="border border-black h-fit">
                <div class="bg-teknik py-5 text-xl font-extrabold text-white text-center">
                    <p>Information</p>
                </div>
                <div class="p-4">
                    <p class="font-medium text-xl text-justify leading-8">Akses Katalog Publik Daring - Gunakan fasilitas pencarian untuk mempercepat penemuan data katalog
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Section 2 --}}
</div>






