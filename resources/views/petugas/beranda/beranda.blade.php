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
                <p class="font-semibold text-3xl">{{ count($biblios) }}</p>
                <p class="font-semibold text-base">Total Koleksi</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M28.5 4.5H10.5C9.30653 4.5 8.16193 4.97411 7.31802 5.81802C6.47411 6.66193 6 7.80653 6 9V27C6 28.1935 6.47411 29.3381 7.31802 30.182C8.16193 31.0259 9.30653 31.5 10.5 31.5H28.5C28.8978 31.5 29.2794 31.342 29.5607 31.0607C29.842 30.7794 30 30.3978 30 30V6C30 5.60218 29.842 5.22064 29.5607 4.93934C29.2794 4.65804 28.8978 4.5 28.5 4.5ZM10.5 28.5C10.1022 28.5 9.72064 28.342 9.43934 28.0607C9.15804 27.7794 9 27.3978 9 27C9 26.6022 9.15804 26.2206 9.43934 25.9393C9.72064 25.658 10.1022 25.5 10.5 25.5H27V28.5H10.5Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-3xl">{{ count($eksemplars) }}</p>
                <p class="font-semibold text-base">Total Eksemplar</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 4H8C7.19465 4.00477 6.4095 4.25253 5.74727 4.71086C5.08505 5.1692 4.5766 5.81676 4.28846 6.56881C4.00032 7.32086 3.9459 8.14238 4.13233 8.92587C4.31876 9.70936 4.73735 10.4183 5.33333 10.96V24C5.33333 25.0609 5.75476 26.0783 6.50491 26.8284C7.25505 27.5786 8.27247 28 9.33333 28H22.6667C23.7275 28 24.7449 27.5786 25.4951 26.8284C26.2452 26.0783 26.6667 25.0609 26.6667 24V10.96C27.2626 10.4183 27.6812 9.70936 27.8677 8.92587C28.0541 8.14238 27.9997 7.32086 27.7115 6.56881C27.4234 5.81676 26.9149 5.1692 26.2527 4.71086C25.5905 4.25253 24.8053 4.00477 24 4ZM20 17.5067C20 17.8143 19.8778 18.1094 19.6602 18.3269C19.4427 18.5445 19.1476 18.6667 18.84 18.6667H13.16C12.8523 18.6667 12.5573 18.5445 12.3398 18.3269C12.1222 18.1094 12 17.8143 12 17.5067V17.16C12 16.8523 12.1222 16.5573 12.3398 16.3398C12.5573 16.1222 12.8523 16 13.16 16H18.84C19.1476 16 19.4427 16.1222 19.6602 16.3398C19.8778 16.5573 20 16.8523 20 17.16V17.5067ZM24 9.33333H8C7.64638 9.33333 7.30724 9.19286 7.05719 8.94281C6.80714 8.69276 6.66667 8.35362 6.66667 8C6.66667 7.64638 6.80714 7.30724 7.05719 7.05719C7.30724 6.80714 7.64638 6.66667 8 6.66667H24C24.3536 6.66667 24.6928 6.80714 24.9428 7.05719C25.1929 7.30724 25.3333 7.64638 25.3333 8C25.3333 8.35362 25.1929 8.69276 24.9428 8.94281C24.6928 9.19286 24.3536 9.33333 24 9.33333Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-3xl">{{ count($loans) }}</p>
                <p class="font-semibold text-base">Dipinjamkan</p>
            </div>
        </div>
        <div class="flex border border-slate-300 p-2.5 rounded-lg">
            <div class="rounded-full border p-3 border-slate-300 mr-3">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 16.5C19.1867 16.5 20.3468 16.1481 21.3335 15.4889C22.3201 14.8296 23.0892 13.8925 23.5433 12.7961C23.9974 11.6998 24.1163 10.4934 23.8847 9.32949C23.6532 8.16561 23.0818 7.09651 22.2427 6.25739C21.4036 5.41828 20.3345 4.84683 19.1706 4.61532C18.0067 4.38381 16.8003 4.50263 15.7039 4.95676C14.6076 5.41088 13.6705 6.17992 13.0112 7.16661C12.3519 8.15331 12 9.31335 12 10.5C12 12.0913 12.6322 13.6175 13.7574 14.7427C14.8826 15.8679 16.4087 16.5 18 16.5Z" fill="#ADB5BD"/>
                    <path d="M27 31.5C27.3978 31.5 27.7794 31.342 28.0607 31.0607C28.342 30.7794 28.5 30.3979 28.5 30C28.5 27.2153 27.3938 24.5445 25.4246 22.5754C23.4555 20.6063 20.7848 19.5 18 19.5C15.2152 19.5 12.5445 20.6063 10.5754 22.5754C8.60625 24.5445 7.5 27.2153 7.5 30C7.5 30.3979 7.65804 30.7794 7.93934 31.0607C8.22064 31.342 8.60218 31.5 9 31.5H27Z" fill="#ADB5BD"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-3xl">{{ count($members) }}</p>
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
                </div>
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
                    <th class="text-left p-3">NO</th>
                    <th class="text-left p-3">NAMA PENGUNJUNG</th>
                    <th class="text-left p-3">INSTITUSI</th>
                    <th class="text-left p-3">TIPE PENGUNJUNG</th>
                    <th class="text-left p-3">WAKTU KUNJUNGAN</th>
                 </tr>
              </thead>
              @php
                  $nomor = 1 + ($visitors->currentPage() - 1) * $visitors->perPage();
              @endphp
              @if ($visitors)
              @foreach ($visitors as $visitor)
              <tbody>
                  @if ($visitors)
                  @foreach ($visitors as $visitor)
                 <tr class="border-b border-solid border-gray-400">
                    <td class="p-3 leading-6 w-80" >{{$nomor++}}</td>
                    <td class="p-3 leading-6 w-80">{{$visitor->name}}</td>
                    <td class="p-3 leading-6 w-80">{{$visitor->institution}}</td>
                    <td class="p-3 leading-6 w-80">{{$visitor->type->name}}</td>
                    <td class="p-3 leading-6 w-80">{{ \Carbon\Carbon::createFromTimestamp(strtotime($visitor->created_at))->format('l, d M Y H:i') }}</td>
                 </tr>
                @endforeach
                @else
                <tr>
                  <th class="pt-6 pb-3 text-center" colspan="4">TIDAK ADA DATA</th>
                </tr>
                @endif
              </tbody>
           </table>
       </div>
    </form>
     <div class="flex justify-end">
        {{$visitors->withQueryString()->render('pagination.custom')}}
        </div>
       {{-- End Section 5 --}}
    </div>
</div>
