@extends('dashboard.main')
@section('active-profil-navbar', 'text-blue-500 border-amber-600')

@section('content')
<div class="pt-32">
    {{-- Section 1 --}}
    {{-- End Section 1 --}}
    {{-- Setion 2 --}}
    <div class="">
        <div class="grid gap-10 grid-cols-3 px-20">
            <div class="col-span-2">
                <div class="bg-teknik py-5 text-xl border-x border-t border-black rounded-t-md font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="px-12 py-10 border-x border-b rounded-b-md border-black">
                    <p class="font-bold text-xl mb-3">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                    <p class="font-medium text-xl mb-3"><span class="font-bold">Alamat :</span> Jl. Prof H. Soedarto, SH., Tembalang, Semarang</p>
                    <p class="font-medium text-xl mb-3"><span class="font-bold">Telp   :</span> (024)7460053</p>
                    <p class="font-medium text-xl mb-3"><span class="font-bold">Fax    :</span> (024)7460055</p>
                    <p class="font-bold text-xl mb-3">Jam layanan:</p>
                    <p class="font-medium text-xl mb-3">Senin - Kamis : 08:00 - 15:30 WIB</p>
                    <p class="font-medium text-xl mb-3">Istirahat     : 12:00 - 13:00 WIB</p>
                    <p class="font-medium text-xl mb-3">Jumat         : 08:00 - 16:00 WIB</p>
                    <p class="font-medium text-xl mb-3">Istirahat     : 11:00 - 13:30 WIB</p>
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

