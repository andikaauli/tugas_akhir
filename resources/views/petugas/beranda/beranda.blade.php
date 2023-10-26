@extends('main.main')
@extends('petugas.beranda.sidebar')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Administrasi Perpustakaan
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2--}}
     <div class="grid grid-cols-4 gap-6 px-6 py-5">
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full p-3 border border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.00002 31.5C8.74233 31.4992 8.4892 31.4321 8.26502 31.305C8.03332 31.1748 7.84038 30.9853 7.70597 30.756C7.57155 30.5267 7.50047 30.2658 7.50002 30V7.995C7.47974 7.09548 7.81476 6.2242 8.43247 5.56999C9.05017 4.91578 9.90081 4.53134 10.8 4.5H25.2C26.0992 4.53134 26.9499 4.91578 27.5676 5.56999C28.1853 6.2242 28.5203 7.09548 28.5 7.995V30C28.4984 30.2618 28.4284 30.5186 28.2968 30.7449C28.1652 30.9712 27.9767 31.1591 27.75 31.29C27.522 31.4217 27.2633 31.491 27 31.491C26.7367 31.491 26.478 31.4217 26.25 31.29L17.745 26.475L9.75002 31.275C9.52435 31.4151 9.26553 31.4927 9.00002 31.5Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-4xl">23</p>
                <p class="font-semibold text-base">Total Koleksi</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.00002 31.5C8.74233 31.4992 8.4892 31.4321 8.26502 31.305C8.03332 31.1748 7.84038 30.9853 7.70597 30.756C7.57155 30.5267 7.50047 30.2658 7.50002 30V7.995C7.47974 7.09548 7.81476 6.2242 8.43247 5.56999C9.05017 4.91578 9.90081 4.53134 10.8 4.5H25.2C26.0992 4.53134 26.9499 4.91578 27.5676 5.56999C28.1853 6.2242 28.5203 7.09548 28.5 7.995V30C28.4984 30.2618 28.4284 30.5186 28.2968 30.7449C28.1652 30.9712 27.9767 31.1591 27.75 31.29C27.522 31.4217 27.2633 31.491 27 31.491C26.7367 31.491 26.478 31.4217 26.25 31.29L17.745 26.475L9.75002 31.275C9.52435 31.4151 9.26553 31.4927 9.00002 31.5Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-4xl">4999</p>
                <p class="font-semibold text-base">Total Eksemplar</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.00002 31.5C8.74233 31.4992 8.4892 31.4321 8.26502 31.305C8.03332 31.1748 7.84038 30.9853 7.70597 30.756C7.57155 30.5267 7.50047 30.2658 7.50002 30V7.995C7.47974 7.09548 7.81476 6.2242 8.43247 5.56999C9.05017 4.91578 9.90081 4.53134 10.8 4.5H25.2C26.0992 4.53134 26.9499 4.91578 27.5676 5.56999C28.1853 6.2242 28.5203 7.09548 28.5 7.995V30C28.4984 30.2618 28.4284 30.5186 28.2968 30.7449C28.1652 30.9712 27.9767 31.1591 27.75 31.29C27.522 31.4217 27.2633 31.491 27 31.491C26.7367 31.491 26.478 31.4217 26.25 31.29L17.745 26.475L9.75002 31.275C9.52435 31.4151 9.26553 31.4927 9.00002 31.5Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-4xl">8</p>
                <p class="font-semibold text-base">Dipinjamkan</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.00002 31.5C8.74233 31.4992 8.4892 31.4321 8.26502 31.305C8.03332 31.1748 7.84038 30.9853 7.70597 30.756C7.57155 30.5267 7.50047 30.2658 7.50002 30V7.995C7.47974 7.09548 7.81476 6.2242 8.43247 5.56999C9.05017 4.91578 9.90081 4.53134 10.8 4.5H25.2C26.0992 4.53134 26.9499 4.91578 27.5676 5.56999C28.1853 6.2242 28.5203 7.09548 28.5 7.995V30C28.4984 30.2618 28.4284 30.5186 28.2968 30.7449C28.1652 30.9712 27.9767 31.1591 27.75 31.29C27.522 31.4217 27.2633 31.491 27 31.491C26.7367 31.491 26.478 31.4217 26.25 31.29L17.745 26.475L9.75002 31.275C9.52435 31.4151 9.26553 31.4927 9.00002 31.5Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-4xl">15</p>
                <p class="font-semibold text-base">Anggota</p>
            </div>
        </div>
     </div>
     {{-- End Section 2--}}
     {{-- Section 3 --}}
     <div class="px-4 pt-4 flex my-5">
        <div class="flex items-center">
           <p class="text-3xl text-black font-bold">
              Tabel Kehadiran Pengunjung
           </p>
        </div>
     </div>
   {{-- End Section 3 --}}
     {{-- Section 4 --}}
       <div class="py-8 px-4 ">
        {{-- Search Bar --}}
           <div class="flex items-center ">
              <p class="mr-3">Cari</p>
              <form class="m-0" action="{{ route('client.visitors-history') }}" method="GET">
                <div class="flex items-center">
                <input type="search" name="search" class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                 placeholder="Search"
                 aria-label="Search"
                 aria-describedby="button-addon3"/>
              {{-- Btn Search --}}
              <button class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
                 Cari
              </button>
            </form>
              {{-- End Btn Search --}}
                </div>
        {{-- End Search Bar --}}
       </div>
       {{-- End Section 4 --}}
       {{-- Section 5 --}}
       <form action="{{ route('client.visitors-history') }}">
        <div class="flex mb-4 ">
           <table class="table-auto w-full">
              <thead class="p-3 border-y border-solid border-gray-400">
                 <tr class="text-sm">
                    <th class="text-left p-3">NAMA PENGUNJUNG</th>
                    <th class="text-left p-3">INSTITUSI</th>
                    <th class="text-left p-3">TIPE PENGUNJUNG</th>
                    <th class="text-left p-3">WAKTU KUNJUNGAN</th>
                 </tr>
              </thead>
              @foreach ($visitors as $visitor)
              <tbody>
                 <tr class="border-b border-solid border-gray-400">
                    <td class="p-3 leading-6 w-80">{{$visitor->name}}</td>
                    <td class="p-3 leading-6 w-80">{{$visitor->institution}}</td>
                    <td class="p-3 leading-6 w-80">{{$visitor->type->name}}</td>
                    <td class="p-3 leading-6 w-80">{{ Carbon\Carbon::parse($visitor->created_at)->format('l, d F Y H:i') }}</td>
                 </tr>
              </tbody>
              @endforeach
           </table>
       </div>
    </form>
       <div class="flex justify-end">
            <div class="bg-gray-500 rounded-lg px-4 py-2 mr-3">
                <p class="text-white text-center font-extrabold">Sebelumnya</p>
            </div>
            <div class="bg-gray-500 rounded-lg w-10 py-2 mr-3">
                <p class="text-white text-center font-extrabold">1</p>
            </div>
            <div class="bg-gray-500 rounded-lg w-10 py-2 mr-3">
                <p class="text-white text-center font-extrabold">2</p>
            </div>
            <div class="bg-gray-500 rounded-lg w-10 py-2 mr-3">
                <p class="text-white text-center font-extrabold">3</p>
            </div>
            <div class="bg-gray-500 rounded-lg px-4 py-2 mr-3">
                <p class="text-white text-center font-extrabold">Berikutnya</p>
            </div>
            <div class="bg-gray-500 rounded-lg px-4 py-2 mr-3">
                <p class="text-white text-center font-extrabold">Hal. Akhir</p>
            </div>
       </div>
       {{-- End Section 5 --}}
    </div>
</div>
